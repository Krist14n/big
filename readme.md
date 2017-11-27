
## About This Project

To run this project follow the next steps:

1. Clone respository 

2. cd into project directory 

3. Execute composer update (if you are in a development environment)

4. Create a .env file inside your app root

		APP_NAME=
		APP_ENV=
		APP_KEY=
		APP_DEBUG=true
		APP_LOG_LEVEL=debug
		APP_URL=http://localhost

		DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=
		DB_DATABASE=
		DB_USERNAME=
		DB_PASSWORD=

		BROADCAST_DRIVER=log
		CACHE_DRIVER=file
		SESSION_DRIVER=file
		QUEUE_DRIVER=sync

		REDIS_HOST=127.0.0.1
		REDIS_PASSWORD=null
		REDIS_PORT=6379

		MAIL_DRIVER=smtp
		MAIL_HOST=smtp.mailtrap.io
		MAIL_PORT=2525
		MAIL_USERNAME=null
		MAIL_PASSWORD=null
		MAIL_ENCRYPTION=null

		PUSHER_APP_ID=
		PUSHER_APP_KEY=
		PUSHER_APP_SECRET=

5. Run migrations

6. Run php artisan migrate

7. Set up a crontab to execute the scheduler that will update users VC every 30 min 
	
	crontab -e 

 then add:

 	* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1


8. To run the application execute: 

	php artisan serve


