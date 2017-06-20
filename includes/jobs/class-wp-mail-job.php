<?php 

class WP_Mail_Job extends WP_Job
{

    /**
     * The arguments for the email being sent
     *
     * @var array
     */
    protected $args;

    /**
     * Construct the job
     *
     * @param array $args
     */
    public function __construct($args)
    {
        $this->args = $args;
    }

    /**
     * Handle the job
     *
     * @return boolean
     */
    public function handle()
    {
        // remove the filter that prevents email sending
        remove_filter('wp_mail', array('WP_Mail_Override', 'capture'));

        // send the email
        wp_mail($this->args['to'], $this->args['subject'], $this->args['message'], $this->args['headers'], $this->args['attachments']);
        
        // reapply the filter that prevents email sending
        add_filter('wp_mail', array('WP_Mail_Override', 'capture'));
        
        return true;
    }
}
