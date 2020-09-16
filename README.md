# Symfony Training App!

Hi amigos! This repository holds a brand new, shiny Symfony application
and Docker setup. The Docker setup is not required - just here to help!

## Setup!

### 1) Get this code!

Use `git` and the magic of the Internet to clone this repository to your
local machine.

### 2) Start Docker

**NOTE**: If you prefer to *not* use Docker, that's ok! See
[no-docker-setup.md](no-docker-setup.md) for details.

To get the application running, first start the Docker containers. From
inside this directory, run:

```
docker-compose up -d
```

> If you get any "port is already allocated" errors, you may already
> have another Docker project running that is trying to share ports
> to your local machine. Try shutting those down. If that doesn't help,
> let me know!

### 3) Initializing the app

Next, "bash" into the `web` container. We'll be running *all* of our
commands from inside this container:

```
docker-compose exec web bash
```

This will take you to the working directory, which is `/var/www`.

Finally, download the Composer dependencies and get the database
set up by running (from inside the `web` container):

```
composer install
```

### 4) Accessing the Site!

That's it! Port `8089` is exposed via docker, so you should now be able
to access the site by going to:

http://127.0.0.1:8089/

If you can see a big happy "Welcome to Symfony" page... you rock!

If not... I'm pretty sure you still rock. And if you need some help
debugging, ping me on Slack - Ryan Weaver.
