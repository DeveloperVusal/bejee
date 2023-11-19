<?php
namespace Core\Http;

enum Status
{
    case Error;
    case Warning;
    case Success;
}

final class Response {

    /**
     * @param Status $status
     * @param int $code
     * @param string $message
     * @param array $result
     */
    function __construct(
        private Status $status,
        private int $code,
        private string $message = '',
        private array $result = [],
    ) {}
    
    /**
     * The method builds of the properties to array
     * 
     * @return array
     */
    public function build(): array
    {
        $result = [
            'status' => $this->status->name,
            'code' => $this->code,
        ];
        
        if ($this->message) $result['message'] = $this->message;
        if ($this->result) $result['result'] = $this->result;

        return $result;
    }

    /**
     * The method create the response like json format
     * 
     * @return string
     */
    public function create(): string
    {
        return json_encode($this->build());
    }
    
    /**
     * This method print to screen result of response
     * 
     * @return void
     */
    public function echo(): void
    {
        echo $this->create();
    }
}