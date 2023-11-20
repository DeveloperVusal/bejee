<?php
namespace Core\Engine;

final class Console {
    /**
     * Command name
     * 
     * @var string
     */
    private string $action;
    /**
     * Command arguments
     * 
     * @var array
     */
    private array $options = [];

    /**
     * Prepare commands for executing
     * 
     * @param array $input
     * commands: serve
     * 
     * @return void
     */
    public function __construct(array $input)
    {
        $this->parseCoomand($input);
    }

    /**
     * This method to parse the cmd command
     * 
     * @access private
     * @param array $_argv
     * 
     * @return void
     */
    private function parseCoomand(array $_argv)
    {
        $this->action = $_argv[1];
        $this->options = array_slice($_argv, 2, sizeof($_argv));
    }

    /**
     * This method execute command after parses command line
     * 
     * @access public
     * @return void
     */
    public function handleCommands()
    {
        $this->command($this->action, $this->options);
    }

    /**
     * The method execute command
     * 
     * @access public
     * @return void
     */
    private function command(string $action, array $options)
    {
        switch ($action) {
            case 'serve':
                exec('php -S localhost:'.((isset($options[0]) && $options[0]) ? $options[0] : '5000').' -t public/');

                break;
            
            default:
                # code...
                break;
        }
    }
}