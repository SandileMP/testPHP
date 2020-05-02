#! /bin/sh

folder=/app

cdate=$(date +"%Y-%m-%d-%H:%M")

host="http://php/logins/"
checkUrl="$host/console/interview/getNew"
startUrl="$host/console/interview/start?interview_id=%d"
completeUrl="$host/console/interview/complete?interview_id=%d&invite_id=%d"
errorUrl="$host/console/interview/error?interview_id=%d&invite_id=%d&log=%s"
echo $checkUrl;
output="$(curl $checkUrl)";
echo $output;
interviewId=$(echo ${output} | jq -r '.interview_id');
inviteId=$(echo ${output} | jq -r '.invite_id');
webmFile=$(echo ${output} | jq -r '.webm');
file=$(echo ${output} | jq -r '.textFile');
mp4File=$(echo ${output} | jq -r '.mp4File');
jqCommand=".streams | map(.codec_name) | join(\",\")";
echo "$jqCommand";
echo $cdate;
echo $interviewId;

  if [ -z "$interviewId" ]; then
    exit 0;
  fi
    cd $folder;
  if [ ! -f "$file" ]; then
    # error file not exist
    outputResult="$(curl $(printf $errorUrl $interviewId $inviteId 'txtFileNotFound'))";
    echo $outputResult;
    exit 0;
  fi
  echo $file;
  if [ "${file##*.}" = "txt" ]; then
    outputResult="$(curl $(printf $startUrl $interviewId))";
    echo $outputResult;
    readarray rows < $file;
    for row in "${rows[@]}"; do
      echo $row;
    done
    number_of_lines=$(wc -l < "$file");
    echo "$number_of_lines";
    isMP4=0;
    isMix=0;
    for row in "${rows[@]}"; do
      echo "$row";
      inputname=${row:11:-1};
      inputname="${inputname%%\'*}";
      echo $inputname;

      cp $inputname original_$inputname;
      jsonresponse="$(/usr/local/bin/ffprobe -i $inputname -hide_banner -show_format -show_streams -v quiet -print_format json)";
      echo $jsonresponse;
      codecs="$(echo $jsonresponse| jq -r '.streams|map(.codec_name)')";
      echo $codecs;
        if [[ $codecs == *"h264"* ]]; then
           isMP4=1;
        else
            if [ ! "$isMP4" -eq "1" ]; then
            isMix=1;
        fi
    fi
    done < $file;
    echo "isMP4: $isMP4";
    echo "isMix: $isMix";

    if [ "$isMP4" -eq "1" ]; then
        echo "its MP4";
        for row in "${rows[@]}"; do
           echo "$row";
           inputnameq=${row:11:-1};
           inputnameq="${inputnameq%%\'*}";
           echo $inputnameq;
           echo "converting to mp4 each";
           /usr/local/bin/ffmpeg -y -i $inputnameq -c:v copy partial_${inputnameq%%.*}.mp4;
           echo "conversion done";
           mv partial_${inputnameq%%.*}.mp4 ${inputnameq%%.*}.mp4;
        done < $file;
        echo "updating txt file";
        sed -i -e "s/\.webm/\.mp4/g" $file;
        cat $file;
        echo "concating mp4 files";
        /usr/local/bin/ffmpeg -y -f concat -safe 0 -i $file partial_${file%%.*}.mp4;
        mv partial_${file%%.*}.mp4 ${file%%.*}.mp4;
        echo "mp4 to webm";
        /usr/local/bin/ffmpeg -i ${file%%.*}.mp4 partial_${file%.*};
        mv partial_${file%.*} ${file%.*};
        echo "Done";
        outputResult="$(curl $(printf $completeUrl $interviewId $inviteId))";
        echo $outputResult;
        echo "exit";
        exit 0;
    else
        for row in "${rows[@]}";
        do
           echo "$row";
           inputname=${row:11:-1};
           inputname="${inputname%%\'*}";
           echo $inputname;
           echo "$(/usr/local/bin/ffmpeg -y -i $inputname -map 0:a -map 0:v -c copy fixed_$inputname)";
           mv fixed_$inputname $inputname;
        done < $file;
        echo "concat";
        /usr/local/bin/ffmpeg -y -f concat -safe 0 -i $file partial_${file%.*};
        mv partial_${file%.*} ${file%.*};
        echo "convert to mp4";
        /usr/local/bin/ffmpeg -y -i ${file%.*} -crf 23 -vf pad="width=ceil(iw/2)*2:height=ceil(ih/2)*2" partial_${file%%.*}.mp4;
        mv partial_${file%%.*}.mp4 ${file%%.*}.mp4;
        echo "Done";
        outputResult="$(curl $(printf $completeUrl $interviewId $inviteId))";
        echo $outputResult;
        echo "exit";
        exit 0;
    fi
  fi
  outputResult="$(curl $(printf $errorUrl $interviewId $inviteId 'txtFileNotFound'))";
  echo $outputResult;
  exit 1;
