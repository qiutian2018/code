#!/bin/bash

read -p 'please input you name:' -t 20 name
echo $name

read -p 'please input you passwd:' -s passwd
echo -e "\n"
echo $passwd

read -p 'please input you sex[M/F]:' -n 1 sex
echo -e "\n"
echo $sex

echo -e "\n"
echo 'your info:'$name $passwd $sex
