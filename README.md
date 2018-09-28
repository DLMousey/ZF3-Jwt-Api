## ZF3-Jwt-Api
JWTs are great, They allow for simple, stateless authentication against an API (or whatever really), They're compact, lightweight, portable, loads of positive sounding terms apply here but there's one major flaw in the JWT ecosystem - **Concrete examples are as rare as rocking horse poop.**

## Why this repo exists

As mentioned above, attempting to find a concrete example of a JWT implementation is a surprisingly difficult task given how proflific the technology is. If you need to add refresh tokens to the mix (to make your API y'know... usable) we go from rocking horse poop to unicorn poop in terms of rarity.

## What this repo is

This repo is supposed to provide a concrete example of how JWTs have been implemented into a real-ish world API, demonstrating all the real world elements such as;

  - How JWTs are protecting the API
  - How certain routes are locked down to particular roles
  - How the refresh tokens work
  - How everything fits together in the bigger picture
  
### Tech in use

This repo contains the API portion of the concrete example, It's a Zend Framework 3 application designed to be used with a boggo standard MySQL/MariaDB database via Doctrine. I could've just had single PHP scripts for creating, validating and refreshing JWTs but then i'd just be contributing to the problem.

There will eventually be a companion repo to this one containing an Angular application that hits this API for all it's JWT...ey needs.

The logic around creating and verifying these things isn't the problem, it's how it all fits into the bigger picture that's the issue so that's what i'm trying to create here. 

## Installation

Right now the installation process is as follows;
```
git clone https://github.com/DLMousey/ZF3-Jwt-Api
cd ZF3-Jwt-Api
composer install
php -S 127.0.0.1:8080 -t public
```

If you want to make changes to the project make sure you enable ZF3's development mode so the config cache is removed (otherwise your config changes won't have any effect);
```
composer development-enable
```

In the near-ish future i'm aiming to support Docker, Vagrant all that jazz.

## Tests

There'll be some.

## Contributing

As i'm sure you're aware it's very easy to get JWTs wrong and leave gaping holes in your application's security - If you do spot something i've done wrong please open a PR with a fix for it with all the relevant information.
