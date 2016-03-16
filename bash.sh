#!/bin/bash
if [ ! -f composer.phar ]; then
	curl -sS https://getcomposer.org/installer | php
fi
if [ ! -f .env ]; then
	cp .env.example .env
	php artisan key:generate
fi
chmod -R 777 bootstrap/cache/
echo chmod dir: bootstrap/cache/

chmod -R 777 storage/
echo chmod dir: storage/

uploadDir=public/uploads/222/

foldes=(public/uploads/ public/uploads/heritages/ public/uploads/heritages/covers/ public/uploads/heritages/thumbnails/ public/uploads/medias/ public/uploads/posts/ public/uploads/sliders/ public/uploads/albums/ public/uploads/images/ public/uploads/thumbnails/  public/uploads/advertisements/)

for i in ${foldes[@]};  do
	if [ ! -d "$i" ]; then
		mkdir "$i"
		echo create dir: $i
	fi
	years=(2016 2017 2018)
	
	if [[ ( "$i" != "${foldes[0]}" ) && ( "$i" != "${foldes[1]}" ) ]]; then
		for j in ${years[@]};  do
			if [ ! -d "$i$j/" ]; then
				mkdir "$i$j/"
				echo create dir: $i$j/
			fi
			for m in 01 02 03 04 05 06 07 08 09 10 11 12
			do 
				if [ ! -d "$i$j/$m/" ]; then
					mkdir "$i$j/$m/"
					echo create dir: $i$j/$m/
				fi
			done
		done
	fi
	chmod -R 777 $i
	echo chmod dir: $i

done

files=(config/settings.php)

for i in ${files[@]};  do
	if [ ! -f "$i" ]; then
		touch "$i"
		echo create file: $i
	fi
	chmod 777 $i
	echo chmod file: $i

done