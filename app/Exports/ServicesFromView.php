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
        $columns,
        $filters
/*         $filter_id = null,
        $filter_category = null,
        $filter_client_id = null,
        $filter_order = null */
    ) {
/*         $this->filter_id = $filter_id;
        $this->filter_category = $filter_category;
        $this->filter_client_id = $filter_client_id;
        $this->filter_order = $filter_order; */
        $this->columns = $columns;
        $this->filters = $filters;
        $this->header = array();
    }
    
    public function query()
    {

        $exportsFilters =  Service::query()->where(function ($query) {
            if ($this->filters['filter_client_id'] != null & $this->filters['filter_client_id'] > 0) {
                $query->where('client_id', $this->filters['filter_client_id']);
            }
            if ($this->filters['filter_category'] != "Selecione") {
                $query->where('category', $this->filters['filter_category']);
            }
            if ($this->filters['filter_order'] != null & $this->filters['filter_order'] > 0) {
                $query->where('order', $this->filters['filter_order']);
            }
        });
        $servicesExports = $exportsFilters;
        //$this->header = array();
        if ($this->columns['id'] != null) {
            $servicesExports = $exportsFilters->addSelect("id");
            $this->header = array_add($this->header, 'id', 'Id Serviço');
        }
        if ($this->columns['category'] != null) {
            $servicesExports = $exportsFilters->addSelect("category");
            $this->header = array_add($this->header, 'category', 'Tipo de Serviço');
        }
        if ($this->columns['client_id'] != null) {
            $servicesExports = $exportsFilters->addSelect("client_id");
            $this->header = array_add($this->header, 'client_id', 'Id do Cliente');
            
        }
        if ($this->columns['description'] != null) {
            $servicesExports = $exportsFilters->addSelect("description");
            $this->header = array_add($this->header, 'description', 'Descrição do Serviço');
        }
        if ($this->columns['model'] != null) {
            $servicesExports = $exportsFilters->addSelect("model");
            $this->header = array_add($this->header, 'model', 'Modelo do Equipamento');
        }
        if ($this->columns['windows_key'] != null) {
            $servicesExports = $exportsFilters->addSelect("windows_key");
            $this->header = array_add($this->header, 'windows_key', 'Licença do Windows');
        }
        if ($this->columns['price'] != null) {
            $servicesExports = $exportsFilters->addSelect("price");
            $this->header = array_add($this->header, 'price', 'Valor');
        }
        if ($this->columns['amount'] != null) {
            $servicesExports = $exportsFilters->addSelect("amount");
            $this->header = array_add($this->header, 'amount', 'Quantidade');
        }
        if ($this->columns['order'] != null) {
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
