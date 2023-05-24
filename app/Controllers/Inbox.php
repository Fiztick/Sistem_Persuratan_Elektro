<?php

namespace App\Controllers;
use App\Models\InboxModel;

class Inbox extends BaseController
{
    public function __construct()
    {
        // $this->request = \Config\Services::request();
        // $this->session = session();
        $this->inbox_model = new InboxModel;
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        $query = "status_inbox < 3";

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->inbox_model->where($query)->countAllResults();
        $this->data['inbox'] = $this->inbox_model->where($query)->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['inbox'])? count($this->data['inbox']) : 0;
        $this->data['pager'] = $this->inbox_model->pager;

        return view('inbox/get', $this->data);
    }

    public function update($id)
    {
        if(!empty($id)) {
            if($this->inbox_model->countAllResults() > 0) {
                $data = ['status_inbox' => $this->request->getVar('status_inbox'),];

                $update = $this->inbox_model->where('id_inbox',$id)->set($data)->update();
                if($update) {
                    return redirect()->to(site_url('inbox'))->with('success', 'Status Berhasil Diupdate');  
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundExecption::forPageNotFound();
            }
        } else {
            return redirect()->to('inventory');
        }
    }

    public function destroy($id) {
        $this->inbox_model->delete($id);
        return redirect()->to(site_url('inbox'))->with('success', 'Data Berhasil Dihapus');
    }
}