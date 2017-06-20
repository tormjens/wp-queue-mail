# WP Queue Mail

A plugin to queue WordPress emails. When sending out emails in bulk the action of sending each of them is both time and resource consuming. That's where queues come in. When you add an e-mail to a queue instead of sending it, it is a matter of adding a row to the database, instead of connecting to the server, sending the contents and so on.

Simply enable the plugin and it will automatically hook in to the `wp_mail` function and start queueing emails.

The queue part was taken from the (Mailchimp for WooCommerce plugin)[https://github.com/mailchimp/mc-woocommerce], but was originally written by (A5hleyRich)[https://github.com/A5hleyRich/wp-background-processing]

## Getting started

The tables needed for the queue to work can be set up using the following WP CLI command in the root of your project.

```
$ wp queue create-tables
```

## The queue

The queue can be processed in two ways.

### Via a WP CLI queue listener

This is my favorite as it runs on the CLI and thus is not affected by the memory and timeout limit of PHP.

Start the queue listener by navigation to the root of your project and type:

```bash
$ wp queue listen
```

To make sure the queue listener is always running you could use something like (Supervisor)[http://supervisord.org/].

### Via WP Cron

This works for most websites running WordPress. The queue is simply added to the WP Cron schedule and executed according to it. 

## Using it for other things than mails

The queue is not specifically bound to sending emails. You can create your own jobs and dispatch them via the features of this plugin.

### The job

A job must extend the `WP_Job` class and contain a `handle` method. You can use a constructor to give the job the data you need processed.

```php 
<?php
class Publish_Podcast extends WP_Job {

	protected $name;

	protected $location;
	
	public function __construct( $name, $location ) {
		$this->name = $name;
		$this->location = $location;
	}

	public function handle() {
		// process the podcast here
	}

}
```

The `handle` method is what will be fired by the queue.

When you are ready to dispatch a job, you can use the convenient `wp_queue` helper function.

```php
<?php 
wp_queue(new Publish_Podcast('Scooby Doo And His Friends', 'iTunes'));
```

The next time the queue is processed the job will be a part of it. Neat!
