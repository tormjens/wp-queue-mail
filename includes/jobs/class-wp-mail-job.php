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
        if (!$this->args['subject'] || !$this->args['message']) {
            return false;
        }

        // send the email
        wp_real_mail($this->args['to'], $this->args['subject'], $this->args['message'], $this->args['headers'], $this->args['attachments']);
        
        
        return true;
    }
}
