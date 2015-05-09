<?php


namespace Hi\core\Lib;

class UriParser
{
    private $params = ['key' => [], 'value' => []];

    private $matching_options = ['key' => [], 'type' => []];

    private $matchTypes = array(
        'int' => '/^[1-9][0-9]*$/',
        'string' => '/^[A-Za-z0-9_-]*$/',
        'hex' => '/^0x[0-9A-F]{1,4}$/',
        '*' => '.+?',
        '**' => '.++',
        '' => '[^/\.]++',
    );

    public function getKeys()
    {
        return $this->params['key'];
    }

    public function getValues()
    {
        return $this->params['value'];
    }

    public function addMatchingOption($key, $type)
    {
        array_push($this->matching_options['key'], $key);
        array_push($this->matching_options['type'], $type);
    }

    public function parseURI($request_uri, $this_uri)
    {

        //We have to map params

        $request_ = $this->frammentURI($request_uri);
        $this_ = $this->frammentURI($this_uri);

        if (count($request_) == count($this_)) {
            foreach ($this_ as $key => $value) {
                if (strpos($value, '$') !== false) {
                    if (in_array(substr($value, strpos($value, '$') + 1), $this->matching_options['key'])) {

                        //Esiste una regola di match
                        $key_ = array_search(substr($value, strpos($value, '$')), $this->matching_options['key']);
                        $matching = $this->matching_options['type'][$key_];
                        if (preg_match($this->matchTypes[$matching], $request_[$key])) {
                            $this->params['key'][] = substr($value, strpos($value, '$'));
                            $this->params['value'][] = $request_[$key];
                        } else {
                            return false;
                        }
                    } else {
                        $this->params['key'][] = substr($value, strpos($value, '$') + 1);
                        $this->params['value'][] = $request_[$key];
                    }
                } else {
                    if ($value !== $request_[$key]) {
                        return false;
                    }
                }
            }

            return true;
        } else {

            //Numero diverso di parametri url

            return false;
        }
    }

    private function frammentURI($string)
    {
        return explode('/', $string);
    }
}
