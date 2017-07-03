<?php

namespace AwesomeMotive\ConvertKit\Service;

class WebhookService extends AbstractService
{
    /**
     * @return \stdClass
     */
    public function all()
    {
        return $this->client->request('automations/hooks', 'get');
    }

    /**
     * @param string $targetUrl
     * @param array  $eventData
     *
     * @return \stdClass
     */
    public function create($targetUrl, $eventData)
    {
        $path = 'automations/hooks';

        $data = array(
            'target_url' => $targetUrl,
            'event' => $eventData,
        );

        return $this->client->request($path, 'post', $data);
    }

    /**
     * @param int $ruleId
     *
     * @return \stdClass
     */
    public function delete($ruleId)
    {
        $path = 'automations/hooks/'.$ruleId;

        return $this->client->request($path, 'delete');
    }
}
