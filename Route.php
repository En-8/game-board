<?php

class Route
{
    private $_uri = array();
    private $_method = array();
    
    /**
     * Build collection of internal URL's
     * @param $uri
     */
     
    public function add($uri, $method = null)
    {
        if ($method != null)
        {
            $this->_method[] = $method;
        }
        
        $this->_uri[] = '/' . trim($uri, '/');
    }
    
    public function submit()
    {
        $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        
        echo $uriGetParam . '<br>';
        
        foreach ($this->_uri as $key => $value)
        {
            $regex = '#^' . $value . '$#';
            if (preg_match($regex, $uriGetParam))
            {
                if (is_string($this->_method[$key]))
                {
                    $useMethod = $this->_method[$key];
                    new $useMethod();
                }
                else
                {
                    call_user_func($this->_method[$key]);
                }
            }
        }
    }
    
}

?>