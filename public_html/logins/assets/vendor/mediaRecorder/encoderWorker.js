function initWorker (workerGlobalScope) {
  const WaveEncoder = require('./WaveEncoder.js');
  const WebMOpusEncoder = require('./WebMOpusEncoder.js');
  const OggOpusEncoder = require('./OggOpusEncoder.js');

  let encoder;

  workerGlobalScope.onmessage = function (e) {
    const { command } = e.data;
    switch (command) {
      case 'loadEncoder':
        const { mimeType, wasmPath } = e.data;
        // Setting encoder module
        let encoderModule;
        switch (mimeType) {
          case 'audio/wav':
          case 'audio/wave':
            encoderModule = WaveEncoder;
            break;

          case 'audio/webm':
          case 'video/webm':
            encoderModule = WebMOpusEncoder;
            break;

          case 'audio/ogg':
            encoderModule = OggOpusEncoder;
            break;
        }
        // Override Emscripten configuration
        let moduleOverrides = {};
        if (wasmPath) {
          moduleOverrides['locateFile'] = function (path, scriptDirectory) {
            return path.match(/.wasm/) ? wasmPath : scriptDirectory + path;
          };
        }
        // Initialize the module
        encoderModule(moduleOverrides).then(Module => {
          encoder = Module;
          // Notify the host ready to accept 'init' message.
          self.postMessage({ command: 'readyToInit' });
        });
        break;

      case 'init':
        const {
          sampleRate,
          channelCount,
          audioBitsPerSecond,
          videoBitsPerSecond,
          width,
          height,
          framerate
        } = e.data;
        encoder.init({
          sampleRate,
          channelCount,
          audioBitsPerSecond,
          videoBitsPerSecond,
          width,
          height,
          framerate
        });
        break;

      case 'pushInputData':
        const { channelBuffers, length, duration } = e.data; // eslint-disable-line
        // On Chrome, Float32Array doesn't recognize its buffer after transferred.
        // So re-create Float32Array right after a web worker received it.
        for (let i = 0; i < channelBuffers.length; i++) {
          channelBuffers[i] = new Float32Array(channelBuffers[i].buffer);
        }

        encoder.encode(channelBuffers);
        break;

      case 'pushVideoData':
        const {videoData} = e.data;
        if (encoder) {
          encoder.encodeVideoFrame(videoData);
        }
        break;

      case 'getEncodedData':
      case 'done':
        if (command === 'done') {
          encoder.close();
        }

        const buffers = encoder.flush();
        self.postMessage(
          {
            command: command === 'done' ? 'lastEncodedData' : 'encodedData',
            buffers
          },
          buffers
        );

        if (command === 'done') {
          self.close();
        }
        break;

      default:
        // Ignore
        break;
    }
  };
}

/* global WorkerGlobalScope */
// Run only if it is in web worker environment
if (
  typeof WorkerGlobalScope !== 'undefined' &&
  self instanceof WorkerGlobalScope
) {
  initWorker(self);
}

/**
 * TODO: This line causes undefined symbol: __webpack_require__
 * So comment out until figuring out the solution
 */
module.exports = initWorker;
