# Secrets

Simple example where the PHP code reads file contents, environment variables and `docker secrets`

You'll need your machine to be in a `swarm` in order to create `secrets` and to `deploy` the application `stack`:
```bash
$ docker swarm init
```

Build the image (`docker stack` ignores the build option so you must do it manually):
```bash
$ docker build -t php:7.2-apache .
Sending build context to Docker daemon  9.728kB
Step 1/2 : FROM php:7.2-apache
 ---> 9f54c9da4b25
Step 2/2 : COPY ./src /var/www/html
 ---> 167874935c8b
Successfully built 167874935c8b
Successfully tagged php:7.2-apache
```

Deploy the stack with `docker stack`;
```bash
$ docker stack deploy -c docker-compose.yml secrets
``` 

Discover the container ID of the `php` service:
```bash
$ docker ps
CONTAINER ID        IMAGE                               COMMAND                  CREATED             STATUS                 PORTS                                                                                              NAMES
d1aa9e4b44f3        php:7.2-apache                      "docker-php-entrypoi…"   13 seconds ago      Up 5 seconds           80/tcp                                                                                             secrets_php.1.tglu9lddywxhynwet92cufw4y
```

Run the example:
# This example prints the secret contents `qc_password`
```bash
$  docker exec -it d1aa9e4b44f3 php qc-secrets.php
{
    "splunk_username": "<< splunk service account username>>",
    "splunk_password": "<< splunk service account password>>",
    "splunk_host": "<< spluk host>>"
}
```
# Use the docker exec command to execute commands in the container and return the result to the command prompt using docker exec <container-id> command.
```bash
$ docker exec -it d1aa9e4b44f3 /bin/bash
root@d1aa9e4b44f3:/var/www/html#
root@d1aa9e4b44f3:/var/www/html# php qc-secrets.php
{
    "splunk_username": "<< splunk service account username>>",
    "splunk_password": "<< splunk service account password>>",
    "splunk_host": "<< spluk host>>"
}
```

# To check whether the `qc_password` secrets are referencing the secret.json file or not
```bash
$ rm secret.json

$ ls
docker-compose.yml  Dockerfile  README.md  src
```
# Again executed the script, it works
```bash
$ docker exec -it d1aa9e4b44f3 php qc-secrets.php
{
    "splunk_username": "<< splunk service account username>>",
    "splunk_password": "<< splunk service account password>>",
    "splunk_host": "<< spluk host>>"
}
```