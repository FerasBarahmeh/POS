<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Messenger;
use APP\LIB\Upload;
use APP\Models\ProductCategoriesModel;
use APP\Models\UserGroupPrivilegeModel;
use APP\Models\UserPrivilegeModel;
use APP\Models\AbstractModel;
use function APP\pr;

class ProductsCategoriesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("productscategories.default");
        $this->_info["categories"] = ProductCategoriesModel::getAll();
        $this->_renderView();
    }

    private function setMessage($category, $message, $type=Messenger::MESSAGE_SUCCESS)
    {
        $this->message->addMessage(
            sprintf($this->language->get($message),
               "<b class='bold-font'>" . $category->Name . "</b>" ),
            $type
        );
    }

    private function setImage(): string
    {
        $upload = new Upload($_FILES["Image"], $this->language, $this->message, $_SERVER["HTTP_REFERER"]);
        $upload->upload();
        return $upload->getEncryptNameFile();
    }
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("productscategories.add");
        $this->language->load("productscategories.messages");
        $this->language->load("messages.files");

        if (isset($_POST["add"])) {
            $category = new ProductCategoriesModel();
            $category->Name = $this->filterStr($_POST["Name"]);
            $category->Image = $this->setImage();

            if ($category->save()) {
                $this->setMessage($category, "message_add_success");

            } else {
                $this->setMessage($category, "message_add_field", Messenger::MESSAGE_DANGER);
            }

            $this->redirect("/productscategories");
        }
        $this->_renderView();
    }

//    private function extractPrivilegesIds($categoryPrivileges): array
//    {
//        $ids = [];
//        if ($categoryPrivileges) {
//            foreach ($categoryPrivileges as $categoryPrivilege) {
//                $ids[] = $categoryPrivilege->PrivilegeId;
//            }
//            return $ids;
//        }
//       return $ids;
//    }

//    private function getDeletePrivileges($oldPrivileges): array
//    {
//        return array_diff($oldPrivileges, $_POST["categories"]);
//    }

//    private function getAddPrivileges($oldPrivileges): array
//    {
//        return array_diff($_POST["categories"], $oldPrivileges);
//    }
//    private function removeDeletePrivilege($old, $category)
//    {
//        $oldPrivileges = $this->getDeletePrivileges($old);
//        foreach ($oldPrivileges as $oldPrivilege) {
//            $target = UserGroupPrivilegeModel::getBy(["PrivilegeId" => $oldPrivilege, "CategoryId" => $category]);
//            $target->current()->delete();
//        }
//    }

//    private function addNewPrivileges($new, $category)
//    {
//        $newPrivileges = $this->getAddPrivileges($new);
//        foreach ($newPrivileges as $newPrivilege) {
//            $categoryPrivilege = new UserGroupPrivilegeModel();
//
//            $categoryPrivilege->CategoryId        = $category;
//            $categoryPrivilege->PrivilegeId    = $newPrivilege;
//            $categoryPrivilege->save();
//        }
//
//    }

//    public function editAction()
//    {
//        $id = $this->_params[0];
//        $category = ProductCategoriesModel::getByPK($id);
//
//        if (! $category) {
//            $this->redirect("/productcategorie");
//        }
//
//        $this->language->load("template.common");
//        $this->language->load("productscategories.edit");
//
//        $this->_info["category"]           = $category;
//        $this->_info["categories"]      = UserPrivilegeModel::getAll();
//        $categories                     =
//            $this->extractPrivilegesIds(UserGroupPrivilegeModel::getBy(["CategoryId" => $category->CategoryId]));
//
//        $this->_info["categoryPrivilege"]  = $categories;
//
//        if (isset($_POST["edit"])) {
//            $category->Name = $this->filterStr($_POST["Name"]);
//
//            if ($category->save()) {
//                if (isset($_POST["categories"]) && is_array($_POST["categories"])) {
//
//                    // Delete Removed Privileges
//                    $this->removeDeletePrivilege($categories, $category->CategoryId);
//
//                    // Add new Privileges
//                    $this->addNewPrivileges($categories, $category->CategoryId);
//
//                }
//                $this->setMessage($category, "text_message_edit_success");
//
//            } else {
//                $this->setMessage($category, "text_message_edit_field", Messenger::MESSAGE_DANGER);
//            }
//
//            $this->redirect("/productcategorie");
//        }
//
//
//        $this->_renderView();
//    }

//    public function deleteAction()
//    {
//        $id = $this->_params[0];
//        $category = ProductCategoriesModel::getByPK($id);
//
//        if (! $category) {
//            $this->redirect("/productcategorie");
//        }
//        $this->language->load("productscategories.default");
//
//        // Delete All Privileges Linked To This Group
//        $categoriesThisGroup = UserGroupPrivilegeModel::getBy(["CategoryId" => $category->CategoryId]);
//        if ($categoriesThisGroup) {
//            foreach ($categoriesThisGroup as $privilegeThisGroup) {
//                $privilegeThisGroup->delete();
//            }
//        }
//
//        if($category->delete()) {
//            $this->setMessage($category, "text_delete_success");
//        } else {
//            $this->setMessage($category, "text_delete_filed", Messenger::MESSAGE_DANGER);
//        }
//        $this->redirect("/productcategorie");
//
//    }
}