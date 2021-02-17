<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServicesFromView implements FromQuery , WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct(
        $title,
        $filter_id = null,
        $filter_category = null,
        $filter_client_id = null,
        $filter_order = null
    ) {
        $this->filter_id = $filter_id;
        $this->filter_category = $filter_category;
        $this->filter_client_id = $filter_client_id;
        $this->filter_order = $filter_order;
        $this->title = $title;
        $this->header = array();
    }
    
    public function query()
    {

        $exportsFilters =  Service::query()->where(function ($query) {
            if ($this->filter_id != null) {
                $query->where('id', $this->filter_id);
            }
            if ($this->filter_category != null) {
                $query->where('category', $this->filter_category);
            }
            if ($this->filter_client_id != null) {
                $query->where('client_id', $this->filter_client_id);
            }
            if ($this->filter_order != null) {
                $query->where('order', $this->filter_order);
            }
        });
        $servicesExports = $exportsFilters;
        //$this->header = array();
        if ($this->title['id'] != null) {
            $servicesExports = $exportsFilters->addSelect("id");
            $this->header = array_add($this->header, 'id', 'Id Serviço');
        }
        if ($this->title['category'] != null) {
            $servicesExports = $exportsFilters->addSelect("category");
            $this->header = array_add($this->header, 'category', 'Tipo de Serviço');
        }
        if ($this->title['client_id'] != null) {
            $servicesExports = $exportsFilters->addSelect("client_id");
            $this->header = array_add($this->header, 'client_id', 'Id do Cliente');
            
        }
        if ($this->title['description'] != null) {
            $servicesExports = $exportsFilters->addSelect("description");
            $this->header = array_add($this->header, 'description', 'Descrição do Serviço');
        }
        if ($this->title['model'] != null) {
            $servicesExports = $exportsFilters->addSelect("model");
            $this->header = array_add($this->header, 'model', 'Modelo do Equipamento');
        }
        if ($this->title['windows_key'] != null) {
            $servicesExports = $exportsFilters->addSelect("windows_key");
            $this->header = array_add($this->header, 'windows_key', 'Licença do Windows');
        }
        if ($this->title['price'] != null) {
            $servicesExports = $exportsFilters->addSelect("price");
            $this->header = array_add($this->header, 'price', 'Valor');
        }
        if ($this->title['amount'] != null) {
            $servicesExports = $exportsFilters->addSelect("amount");
            $this->header = array_add($this->header, 'amount', 'Quantidade');
        }
        if ($this->title['order'] != null) {
            $servicesExports = $exportsFilters->addSelect("order");
            $this->header = array_add($this->header, 'order', 'Numero da Ordem');
        }   

        return $servicesExports;
    }

  
    public function headings(): array
    {
        return [
            'Id Serviço',
            'Tipo de Serviço',
            'Id do Cliente',
            'Descrição do Serviço',
            'Modelo do Equipamento',
            'Licença do Windows',
            'Valor',
            'Quantidade',
            'Numero da Ordem'
        ];
    } 


}
