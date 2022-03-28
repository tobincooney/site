#!/bin/bash
# a little script to set everything up after updating stuff

echo "copying index.php to subdirectories"

# update this list as the folder structure on the remote changes
cp index.php archive/2021/iac/
cp index.php archive/2021/darkroom/
cp index.php archive/2021/adv-port-2/
cp index.php archive/2021/adv-port-2/merge-conflict/
cp index.php archive/2022/adv-pho-2/
cp index.php archive/2022/painting/

echo "removing index.php"
rm index.php
