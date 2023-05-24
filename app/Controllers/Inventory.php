<?php

namespace App\Controllers;
use App\Models\InventoryModel;

class Inventory extends BaseController
{
    public function __construct()
    {
        // $this->request = \Config\Services::request();
        // $this->session = session();
        $this->inventory_model = new InventoryModel;
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {        
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->inventory_model->countAllResults();
        $this->data['inventory'] = $this->inventory_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['inventory'])? count($this->data['inventory']) : 0;
        $this->data['pager'] = $this->inventory_model->pager;

        return view('inventory/get', $this->data);
    }

    public function create() 
    {
        return view('inventory/add');
    }

    public function store()
    {        
        $data = [
            'no_surat' => $this->request->getVar('no_surat'),
            'kode_surat' => $this->request->getVar('kode_surat'),
            'perihal_surat' => $this->request->getVar('perihal_surat'),
            'tanggal_surat' => $this->request->getVar('tanggal_surat'),
            'tanggal_terima_surat' => $this->request->getVar('tanggal_terima_surat'),
            'asal_surat' => $this->request->getVar('asal_surat'),
            'tindak_lanjut' => $this->request->getVar('tindak_lanjut'),
        ];

        if($data['tanggal_surat']  > $data['tanggal_terima_surat']) {
            return redirect()->to(site_url('inventory/add'))->with('error', 'Tanggal Surat Tidak Melebihi Tanggal Terima Surat');
        } else {
            $save = $this->inventory_model->save($data);

            if($save) {
                return redirect()->to(site_url('inventory'))->with('success', 'Data Berhasil Ditambahkan');
            }
        }

        
    }

    public function edit($id = null)
    {
        if(!empty($id)) {
            $query = $this->inventory_model->find($id);
            if($this->inventory_model->countAllResults() > 0) {
                $this->data['inventory'] = $query;
                return view('inventory/edit', $this->data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundExecption::forPageNotFound();
            }
        } else {
            return redirect()->to('inventory');
        }
    }

    public function update($id)
    {
        // $data = $this->request->getPost();
        // unset($data['_method']);

        if(!empty($id)) {
            if($this->inventory_model->countAllResults() > 0) {
                $data = [
                    'no_surat' => $this->request->getVar('no_surat'),
                    'kode_surat' => $this->request->getVar('kode_surat'),
                    'perihal_surat' => $this->request->getVar('perihal_surat'),
                    'tanggal_surat' => $this->request->getVar('tanggal_surat'),
                    'tanggal_terima_surat' => $this->request->getVar('tanggal_terima_surat'),
                    'asal_surat' => $this->request->getVar('asal_surat'),
                    'tindak_lanjut' => $this->request->getVar('tindak_lanjut'),
                ];
            
                $update = $this->inventory_model->where('id_inventory',$id)->set($data)->update();
                if($update) {
                    return redirect()->to(site_url('inventory'))->with('success', 'Data Berhasil Diupdate');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundExecption::forPageNotFound();
            }
        } else {
            return redirect()->to('inventory');
        }
    }

    public function destroy($id) {
        $this->inventory_model->delete($id);
        return redirect()->to(site_url('inventory'))->with('success', 'Data Berhasil Dihapus');
    }
}