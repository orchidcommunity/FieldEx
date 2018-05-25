<?php

declare(strict_types=1);

namespace Orchids\FieldEx\Fields;

use Orchid\Platform\Fields\Builder;

class BuilderEx extends Builder
{
    
    
    public $groupFieldName;
    
    
     /**
     * Generate a ready-made html form for display to the user.
     *
     * @return string
     * @throws \Throwable
     */
    public function generateForm() : string
    {
        foreach ($this->fields as $field) {
            
            if(is_array($field)){
                //dump($field);
                $this->renderGroup($field);
                continue;
            } 
            
            if ($field->get('groups')) {
                //dump('myField1');
                //dump($field->get('groups'));
                //dd($field);
                $this->renderGroups($field,$field->get('groups'));
                continue;
            }
            //dd(get_class($field));
            $this->form .= $this->render($field);
        }

        return $this->form;
    }
 
     /**
     * @param $groupField
     * @throws \Throwable
     */
    private function renderGroups($groupField,$col){
        //dump('renderGroup');
        //dd($groupField);
        //foreach ($groupField as $field){
            //$group[] = $this->render($field);
            //$groupField->set('name',$groupField->get('name').'.');
            //dump($groupField->get('name'));
            $this->groupFieldName=$groupField->get('name');
        for ($i=0;$i<=$col;$i++) {
            $groupField->set('name',$this->groupFieldName.'.'.$i);
            $group[] = $this->render($groupField);
        }
        //}

        $this->form .= view('orchids/fieldex::partials.fields.groupex',[
            'cols' => $group ?? [],
        ])->render();
    }
 
     /**
     * @param $groupField
     * @throws \Throwable
     */
    private function renderGroup($groupField){
        //dump('renderGroup');
        //dd($groupField);
        foreach ($groupField as $field){
            $group[] = $this->render($field);
        }

        $this->form .= view('dashboard::partials.fields.groups',[
            'cols' => $group ?? [],
        ])->render();
    }
    
    /**
     * Render field for forms
     *
     * @param $field
     * @return mixed
     */
    private function render($field){
        $field->set('lang', $this->language);
        $field->set('prefix', $this->buildPrefix($field));
        
        foreach ($this->fill($field->getAttributes()) as $key => $value) {
            $field->set($key, $value);
        }

        return $field->render();
    }
    
        /**
     * @param $field
     *
     * @return string
     */
    private function buildPrefix($field)
    {
        $prefix = $field->get('prefix', null);

        if (! is_null($prefix)) {
            foreach (array_filter(explode(' ', $prefix)) as $name) {
                $prefix .= '['.$name.']';
            }

            return $prefix;
        }

        return $this->prefix;
    }
    
    /**
     * @param $attributes
     *
     * @return mixed
     */
    private function fill($attributes)
    {
        //dump($attributes);
        $name = array_filter(explode(' ', $attributes['name']));
        $name = array_shift($name);

        $attributes['value'] = $this->getValue($name, $attributes['value'] ?? null);

        $binding = explode('.', $name);
        if (! is_array($binding)) {
            return $attributes;
        }

        $attributes['name'] = '';
        foreach ($binding as $key => $bind) {
            if (! is_null($attributes['prefix'])) {
                $attributes['name'] .= '['.$bind.']';
                continue;
            }

            if ($key === 0) {
                $attributes['name'] .= $bind;
                continue;
            }

            $attributes['name'] .= '['.$bind.']';
        }
        /*
        if (isset($attributes['groups'])) {
            if ($attributes['groups']>0) {
                $attributes['name'] .= '[]';
            }
        }*/
        return $attributes;
    }
    
     /**
     * Gets value of Repository
     *
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    private function getValue(string $key, $value = null)
    {
        if (! is_null($this->language)) {
            $key = $this->language.'.'.$key;
        }

        if (! is_null($this->prefix)) {
            $key = $this->prefix.'.'.$key;
        }

        $data = $this->data->getContent($key);

        if (! is_null($value) && $value instanceof \Closure) {
            return $value($data, $this->data);
        }

        return $data;
    }
    
}    