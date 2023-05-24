<?php

namespace App\Controllers;
use App\Models\InboxModel;

class Mailbox extends BaseController
{
    public function __construct()
    {
        // $this->request = \Config\Services::request();
        // $this->session = session();
        $this->mailbox_model = new InboxModel;
        // $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        $query = "status_inbox >= 3";

        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->mailbox_model->where($query)->countAllResults();
        $this->data['mailbox'] = $this->mailbox_model->where($query)->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['mailbox'])? count($this->data['mailbox']) : 0;
        $this->data['pager'] = $this->mailbox_model->pager;

        return view('mailbox/get', $this->data);
    }

    public function update($id)
    {
        if(!empty($id)) {
            if($this->mailbox_model->countAllResults() > 0) {
                $data = ['status_inbox' => $this->request->getVar('status_inbox'),];

                $update = $this->mailbox_model->where('id_inbox',$id)->set($data)->update();
                if($update) {
                    return redirect()->to(site_url('mailbox'))->with('success', 'Status Berhasil Diupdate');  
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
        return redirect()->to(site_url('mailbox'))->with('success', 'Data Berhasil Dihapus');
    }
}