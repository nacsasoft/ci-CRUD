<?php

namespace App\Controllers;

//use App\Controllers\BaseController;
use App\Models\MemberModel;

class Member extends BaseController
{
	public function addMember()
    {
        if ($this->request->getMethod() == "post") {

            $rules = [
                "name" => "required|min_length[3]|max_length[40]",
                "email" => "required|valid_email",
                "mobile" => "required|min_length[9]|max_length[15]",
            ];

            if (!$this->validate($rules)) {

                return view('add-member', [
                    "validation" => $this->validator,
                ]);
            } else {

                $memberModel = new MemberModel();

                $data = [
                    'name' => $this->request->getVar("name"),
                    'email' => $this->request->getVar("email"),
                    'mobile' => $this->request->getVar("mobile"),
                ];

                $memberModel->save($data);

                $session = session();
                $session->setFlashdata("success", "Member created successfully");
                return redirect()->to(base_url('list-members'));
            }
        }

        return view('add-member');
    }

    public function listMember()
    {
        $memberModel = new MemberModel();

        $members = $memberModel->findAll();

        return view('list-members', [
            "members" => $members,
        ]);
    }

    public function editMember($id = null)
    {
        $memberModel = new MemberModel();

        $member = $memberModel->where("id", $id)->first();

        if ($this->request->getMethod() == "post") {

            $rules = [
                "name" => "required|min_length[3]|max_length[40]",
                "email" => "required|valid_email",
                "mobile" => "required|min_length[9]|max_length[15]",
            ];

            if (!$this->validate($rules)) {

                return view('edit-member', [
                    "validation" => $this->validator,
                    "member" => $member,
                ]);
            } else {

                $data = [
                    'name' => $this->request->getVar("name"),
                    'email' => $this->request->getVar("email"),
                    'mobile' => $this->request->getVar("mobile"),
                ];

                $memberModel->update($id, $data);

                $session = session();
                $session->setFlashdata("success", "Member updated successfully");
                return redirect()->to(base_url('list-members'));
            }
        }

        return view('edit-member', [
            "member" => $member,
        ]);
    }

    public function deleteMember($id = null)
    {
        $memberModel = new MemberModel();
        $member = $memberModel->delete($id);

        $session = session();
        $session->setFlashdata("success", "Member deleted successfully");

        return redirect()->to(base_url('list-members'));
    }
}
