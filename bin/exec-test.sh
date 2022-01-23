#!/bin/sh

echo ""

docker container exec loft-php composer run tests

echo ""
