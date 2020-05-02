#! /bin/sh

folder=/app

cdate=$(date +"%Y-%m-%d-%H:%M")
file=$1

number_of_lines=$(wc -l < "$file");
echo "  $number_of_lines  ";
if [ "$number_of_lines" -gt "0" ]; then
  echo "first command";
  #ffmpeg -y -f concat -safe 0 -i $file partial_${file%.*};
  #mv partial_${file%.*} ${file%.*};
fi
if [ ! -f "${file%.*}" ]; then
  echo "first v2 command";
  #ffmpeg -y -f concat -safe 0 -i $file partial_${file%.*};
  #mv partial_${file%.*} ${file%.*};
fi
echo "second command";
echo "from ${file%.*} to ${file%%.*}.mp4";
#ffmpeg -y -i ${file%.*} -crf 26 -vf pad="width=ceil(iw/2)*2:height=ceil(ih/2)*2" partial_${file%%.*}.mp4;
#mv partial_${file%%.*}.mp4 ${file%%.*}.mp4;

