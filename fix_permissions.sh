#!/bin/sh
chown nginx:nginx -R ./
cd application/
chmod 777 -R logs/ cache/
cd ../media/
chmod 777 -R ad_images/
