<?php

namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Messenger;
use APP\LIB\Upload;
use APP\LIB\Validation;
use APP\Models\ProductCategoriesModel;
use function APP\pr;

class ProductsCategoriesController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use Validation;
    private array $_rolesValid = [
        "Name"              => ["req", "alphanum",  "between(2,30)",],
    ];
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

    private function setImage($obj=null): string
    {
        if (!empty($_FILES["Image"])) {
            $upload = new Upload($_FILES["Image"], $this->language, $this->message, $_SERVER["HTTP_REFERER"]);
            $upload->upload();
            return $upload->getEncryptNameFile();
        }

        if (! $obj) {
            return '';
        }

        return $obj->Image;

    }
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("productscategories.add");
        $this->language->load("messages.errors");
        $this->language->load("productscategories.messages");
        $this->language->load("messages.files");

        if (isset($_POST["add"]) && $this->isAppropriate($this->_rolesValid, $_POST)) {
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


    public function editAction()
    {
        $id = $this->_params[0];
        $category = ProductCategoriesModel::getByPK($id);

        if (! $category) {
            $this->redirect("/productscategories");
        }

        $this->language->load("template.common");
        $this->language->load("productscategories.edit");
        $this->language->load("messages.errors");
        $this->language->load("productscategories.messages");
        $this->language->load("messages.files");


        $this->_info["category"]           = $category;

        if (isset($_POST["edit"])  && $this->isAppropriate($this->_rolesValid, $_POST)) {
            $category->Name = $this->filterStr($_POST["Name"]);
            $category->Image = $this->setImage($category)  ;

            if ($category->save()) {
                $this->setMessage($category, "message_edit_success");
            } else {
                $this->setMessage($category, "message_edit_field", Messenger::MESSAGE_DANGER);
            }

            $this->redirect("/productscategories");
        }


        $this->_renderView();
    }

    public function deleteAction()
    {
        $id = $this->_params[0];
        $category = ProductCategoriesModel::getByPK($id);

        if (! $category) {
            $this->redirect("/productscategories");
        }
        $this->language->load("productscategories.messages");


        if($category->delete()) {
            $this->setMessage($category, "message_delete_category_success");
        } else {
            $this->setMessage($category, "message_delete_category_fail", Messenger::MESSAGE_DANGER);
        }
        $this->redirect("/productscategories");

    }
}