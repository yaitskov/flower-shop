#!/bin/bash

fail(){
    echo "Error $1"
    exit 1
}

rm -rf donbuket.tar.gz


tar -zcf donbuket.tar.gz  apps  config  donbuket.ru lib \
      web cache  data  log  plugins  test || fail "create archive"


ncftpput  -u user162 -p 8GKdY/W1m8lcl1zj 77.221.159.147 www donbuket.tar.gz
