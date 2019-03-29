#!/bin/bash

echo "diff of $* and $@"
for i in "$*"
    do
        echo 'for in $*:'$i
    done

for i in "$@"
    do
        echo 'for in $@:'$i
    done
echo "number of param is:$#"

