<?php

namespace Examinecom\ConvertKit\Service;

class CustomFieldsService extends AbstractService
{
    /**
     * @return \stdClass
     */
    public function all()
    {
        return $this->client->request('custom_fields');
    }

    /**
     * @param string $label
     *
     * @return \stdClass
     */
    public function create($label)
    {
        $path = 'custom_fields';

        $data = array(
            'label' => $label,
        );

        return $this->client->request($path, 'post', $data);
    }

    /**
     * @param int $customFieldId
     *
     * @return \stdClass
     */
    public function delete($customFieldId)
    {
        $path = 'custom_fields/'.$customFieldId;

        return $this->client->request($path, 'delete');
    }
}
