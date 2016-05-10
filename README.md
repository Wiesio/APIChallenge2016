What to Pick?
================

What to pick? is an online app aiming to help players pick most suitable champion in a game draft. To do this, the application server gathers data about recent games and converts them into statistics which are used to predict a winning chance for player's most used champions (based on champion mastery level).

Application demo is available at [What2Pick.LoL](http://vps276282.ovh.net)

##Installation

The application is written in PHP [Symfony Framework](http://symfony.com/) so it requires PHP interpreter installed along with some web server and SQL database (LAMP/WAMP platform is good enough). Additionally it utilizes [RabbitMQ](https://www.rabbitmq.com/) queueing to control rate of requests sent to Riot API endpoints.

To install software on your server, clone this repository and within main directory use [Composer](https://getcomposer.org/) to install dependencies.

`composer install`

During installation you'll be asked for a few configuration parameters like database credentials and your Riot API key (also some mailing stuff, but you can skip it, the app doesn't use it anyway).

Next you'll need to create database schema using this command:

`php bin/console doctrine:schema:create`

Once your database is ready, you can start RabbitMQ RPC server serving API requests by running:

`php bin/console rabbitmq:rpc-server riot_api_response_eune`

Currently the application is configured to support three API endpoint: EUNE, EUW and NA. You can quite easli extend it by editing `app/config/services.yml` file. Here is sample configuration for EUNA API endpoint:

    riot_api_response_eune_server:
        class: AppBundle\Consumer\RiotApiRequestConsumer
        arguments:
            - 'https://eune.api.pvp.net/'
            - '%riot.api.key%'

    api_request_queue_collection:
        class: AppBundle\Riot\ApiRequestQueueCollection
        calls:
            - [addRequestQueue, ['eune', '@old_sound_rabbit_mq.riot_api_request_eune_rpc', 'riot_api_response_eune']]
            # You should add all request queue services here
            #- [addRequestQueue, ['euw',  '@old_sound_rabbit_mq.riot_api_request_euw_rpc',  'riot_api_response_euw']]

Once RPC server is up and running you can sed database with some basic information. Run this command to download a list of champions for chosen region:

`php bin/console champions:all eune`

It's a good idea to create a CRON job running this command from time to time and refreshing data. Now you need to provide a summoner name, preferably an active one:

`php bin/console summoners:by-names eune SomeSummonerName`

To start downloading match data you need to run

`php bin/console fetch:data eune`

It downloads one match at a time, so you better set it as CRON job. Once you've downloaded some matches it's time for a last step - generate a set of viable roles for each champion based on matches played by community.

`php bin/console compute:viable-roles`

A role is considered viable for a champion when it appears in at least 10% of games played so make sure you've downloaded at least few hundred matches to get representative results. Once again it's good to set it as CRON job to reflect changes in meta.

There are a few additional commands available for fetching data manually (you can run each one of them with `--help` option to display a set of arguments and options):
*   `match-list:by-player-id`
    
    Downloads a set of matches played by summoners with given ID

*   `match-by-id`

    Fetches a match by its ID

*   `champion-masteries:by-player-id`

    Downloads a set of champion masteries for a player with given ID

## Usage

Main page of application contains a textbox, where you can provide your summoner name and select where you can choose your region. Once you successfully find your summoner, you'll be redirected to a page similar to a champion select lobby. 

There will be two champion list. First one contains your highest ranked champions (rank is displayed in the upper left corner). Number in lower right corner indicates a predicted chance to win. Below is a second list - suggested bans. It's based on most banned champions for last week and it can help you if you can't decide what to ban. 

Next there is a select containig a list of possible roles. Choose your role to filter your suggested champions accordingly.

You can choose champions which were banned to hide them from your suggested champions list and you can also mark champions chosen by your allies/opponents to further improve estimate.

Win chance prediction for given champion takes into account the number of games where that champion either played with one of your allied champions or versus one of the opponents. The predicted chance is an average outcome of these games.