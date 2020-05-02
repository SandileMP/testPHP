FROM jrottenberg/ffmpeg

ADD crontab /etc/cron.d/hello-cron
RUN chmod 0644 /etc/cron.d/hello-cron
RUN apt-get update && apt-get install -y cron jq curl inotify-tools rsyslog
# Create the log file to be able to run tail
RUN crontab /etc/cron.d/hello-cron
RUN touch /var/log/cron.log
# Run the command on container startup
ADD video.sh /etc/video.sh
ADD video1.sh /etc/video1.sh
COPY docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT [ "/bin/bash" ]
CMD ["/docker-entrypoint.sh"]