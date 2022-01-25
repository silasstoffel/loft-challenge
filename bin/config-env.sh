#!/bin/sh

echo "";

echo "Instalação de dependencias [start]";
docker container exec loft-php composer install
echo "Instalação de dependencias [finish]";

echo "";

echo "Aplicação de Permissões [start]";
docker container exec loft-php chown -Rf www-data:www-data ./storage
echo "Aplicação de Permissões  [finish]";


echo "";

#echo "Executando Migrations [start]";
#docker container exec loft-php php artisan migrate --seed
#echo "Executando Migrations [finish]";

echo ""
