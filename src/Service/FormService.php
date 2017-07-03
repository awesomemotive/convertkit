<?php

namespace AwesomeMotive\ConvertKit\Service;

class FormService extends AbstractService
{
    /**
     * @return \stdClass
     */
    public function all()
    {
        return $this->client->request('forms');
    }

    /**
     * @param int   $formId
     * @param array $data
     *
     * @return \stdClass
     */
    public function subscribe($formId, $data)
    {
        $path = 'forms/'.$formId.'/subscribe';

        return $this->client->request($path, 'post', $data);
    }

    /**
     * @param int    $formId
     * @param stgrin $sortOrder
     *
     * @return \stdClass
     */
    public function subscriptions($formId, $sortOrder = null)
    {
        $path = 'forms/'.$formId.'/subscriptions';

        $params = array();

        if (isset($sortOrder)) {
            $params['sort_order'] = $sortOrder;
        }

        return $this->client->request($path, 'get', $params);
    }
}
