<?php

namespace KarimQaderi\ZoroasterFilemanager;

use KarimQaderi\Zoroaster\Fields\Extend\Field;
use KarimQaderi\Zoroaster\Fields\Traits\Resource;
use KarimQaderi\Zoroaster\Traits\ResourceRequest;
use KarimQaderi\ZoroasterFilemanager\Http\Services\FileManagerService;

class FilemanagerField extends Field
{
    use Resource;
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'field';
    public $nameViewForm = 'filemanager';
    public $textAlign='center';

    /**
     * Set display in details and list as image or icon.
     *
     * @return $this
     */
    public function displayAsImage()
    {
        return $this->withMeta(['display' => 'image']);
    }

    /**
     * Set current folder for the field.
     *
     * @param   string  $folderName
     *
     * @return  $this
     */
    public function folder($folderName)
    {
        return $this->withMeta(['folder' => $folderName]);
    }

    /**
     * Resolve the thumbnail URL for the field.
     *
     * @return string|null
     */
    public function resolveInfo()
    {
        if ($this->value) {
            $service = new FileManagerService();

            $data = $service->getFileInfoAsArray($this->value);

            if (empty($data)) {
                return [];
            }

            return $this->fixNameLabel($data);
        }

        return [];
    }

    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        return array_merge($this->resolveInfo(), $this->meta);
    }

    /**
     * FIx name label.
     *
     * @param array $data
     *
     * @return array
     */
    private function fixNameLabel(array $data): array
    {
        $data['filename'] = $data['name'];
        unset($data['name']);

        return $data;
    }


    public function viewForm($field , $data , $resourceRequest = null)
    {
        try{

            return view('Zoroaster-filemanager::field.Form-' . $field->nameViewForm)->with(
                [
                    'field' => $field ,
                    'data' => $data ,
                    'value' => isset($data->{$field->name}) ? $data->{$field->name} : null ,
                    'resourceRequest' => $resourceRequest ,
                ])->render();
        } catch(\Exception $exception){
            throw new \Exception($exception);
        }

    }

    /**
     * @param Field $field
     * @param $data
     * @param null $resourceRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function viewDetail($field , $data , $resourceRequest = null)
    {

        try{
            return view('Zoroaster-filemanager::field.Detail-' . $field->nameViewForm)->with(
                [
                    'field' => $field ,
                    'data' => $data ,
                    'value' => $this->displayCallback($data , $resourceRequest , $field) ,
                    'resourceRequest' => $resourceRequest ,
                ]);
        } catch(\Exception $exception){
            throw new \Exception($exception);
        }
    }

    /**
     * @param $field
     * @param $data
     * @param ResourceRequest $resourceRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function viewIndex($field , $data , $resourceRequest = null)
    {

        try{

            if(!is_null($resourceRequest))
                $resourceRequest->Resource()->resource = $data;

            return view('Zoroaster-filemanager::field.Index-' . $field->nameViewForm)->with(
                [
                    'field' => $field ,
                    'data' => $data ,
                    'value' => $this->displayCallback($data , $resourceRequest , $field) ,
                    'resourceRequest' => $resourceRequest ,
                ]);
        } catch(\Exception $exception){
            throw new \Exception($exception);
        }
    }

}
