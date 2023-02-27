<?php

namespace APP\Controllers;

use APP\Enums\StatusProduct;
use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\LIB\Messenger;
use APP\LIB\Template\Units;
use APP\LIB\Upload;
use APP\LIB\Validation;
use APP\Models\ProductCategoriesModel;
use APP\Models\ProductModel;
use function APP\pr;

class ProductsController extends AbstractController
{
    use FilterInput;
    use PublicHelper;
    use Validation;
    private array $_rolesValid = [
        "CategoryId"        => ["req", "int",],
        "Name"              => ["req", "alphaNum",  "between(1,50)",],
        "Quantity"          => ["req", "posInt",],
        "BuyPrice"          => ["req", "num",],
        "SellPrice"         => ["req", "num",],
        "BarCode"           => ["req",  "between(2,20)",],
        "Unit"              => ["req", "num"],
        "Status"            => ["req", "int"],
//        "Description"       => ["alphaNum"],
    ];

    /**
     * @throws \ReflectionException
     */
    public function defaultAction()
    {
        $this->language->load("template.common");
        $this->language->load("products.default");
        $this->language->load("products.status");
        $this->language->load("products.units");
        $this->language->load("products.messages");
        $this->_info["products"] = ProductModel::getProducts();
        $this->_info["units"]       = $this->getClassValuesProperties(new Units());
        $this->_info["status"]       = $this->getClassValuesProperties(new StatusProduct());
        $this->_renderView();
    }

    private function setMessage($keyWord, array $params, $type=Messenger::MESSAGE_SUCCESS)
    {
        $this->message->addMessage(
            $this->language->feedKey($keyWord, $params),
            $type
        );
    }
    private function removeImage($obj)
    {
        if (file_exists(IMAGES_UPLOAD_PATH . DS . $obj->Image)) {
            unlink(IMAGES_UPLOAD_PATH . DS . $obj->Image);
        }
    }
    private function checkTypeActionPostToSetImgName($upload, $obj)
    {
        $id = $obj::class::getPrimaryKey();
        if ($obj->$id == null) { // Mean Add Action
            $obj->Image = $upload->getEncryptNameFile();
        } else {
            // Edit Action Must Remove previous image
            $this->removeImage($obj);
        }
    }

    private function setMessagesFilesErrors(string $s): array
    {
        $params = explode('|', $s);
        $nameMessageError = array_shift($params);

        return  [
            "nameMessage"   => $nameMessageError,
            "paramMessage"  => $params,
        ];
    }
    private function setImage($obj): null|string
    {
        $findErrors = false;
        if (!empty($_FILES["Image"]["name"])) {
            $upload = new Upload($_FILES["Image"], $this->language, $_SERVER["HTTP_REFERER"]);
            try {
                $upload->upload();
            } catch ( \Exception $e) {
                $m =  $this->setMessagesFilesErrors($e->getMessage());

                $this->message->addMessage(
                    $this->language->feedKey($m["nameMessage"], $m["paramMessage"]),
                  Messenger::MESSAGE_DANGER
                );
                $findErrors = true;
            }

            if ($findErrors) {
                $findErrors = false;
                $this->redirect("/products/add");
                exit();
            }

            $this->checkTypeActionPostToSetImgName($upload, $obj);
            $obj->Image = $upload->getEncryptNameFile();
        }

        if (! $obj) {
            return '';
        }
        return $obj->Image;
    }

    /**
     * @param mixed $product
     * @return void
     */
    private function setProperties(mixed $product): void
    {
        $product->Name          = $this->filterStr($_POST["Name"]);
        $product->Quantity      = $this->filterInt($_POST["Quantity"]);
        $product->BuyPrice      = $this->filterFloat($_POST["BuyPrice"]);
        $product->SellPrice     = $this->filterFloat($_POST["SellPrice"]);
        $product->Unit          = $this->filterFloat($_POST["Unit"]);
        $product->CategoryId    = $this->filterInt($_POST["CategoryId"]);
        $product->BarCode       = $this->filterStr($_POST["BarCode"]);
        $product->Tax           = $this->filterFloat($_POST["Tax"]);
        $product->Status        = $this->filterInt($_POST["Status"]);
        $product->Description        = $this->filterStr($_POST["Description"]);
        $this->setImage($product);
    }

    /**
     * @throws \ReflectionException
     */
    public function addAction()
    {
        $this->language->load("template.common");
        $this->language->load("products.add");
        $this->language->load("messages.errors");
        $this->language->load("products.messages");
        $this->language->load("products.units");
        $this->language->load("products.status");
        $this->language->load("products.common");
        $this->language->load("messages.files");

        $this->_info["categories"] = ProductCategoriesModel::getAll();
        $this->_info["units"]      = $this->getClassValuesProperties(new Units());
        $this->_info["status"]     = $this->getClassValuesProperties(new StatusProduct());


        if (isset($_POST["add"]) && $this->isAppropriate($this->_rolesValid, $_POST) ) {
            $product = new ProductModel();
            $this->setProperties($product);


            if ($product->save()) {
                $this->setMessage("message_add_success", [$product->Name]);

            } else {
                $this->setMessage("message_add_field", [$product->Name], Messenger::MESSAGE_DANGER);
            }

            $this->redirect("/products");
        }
        $this->_renderView();
    }


    /**
     * @throws \ReflectionException
     */
    public function editAction()
    {
        $id = $this->_params[0];
        $product = ProductModel::getByPK($id);

        if (! $product) {
            $this->redirect("/products");
        }

        $this->language->load("template.common");
        $this->language->load("products.edit");
        $this->language->load("messages.errors");
        $this->language->load("products.messages");
        $this->language->load("products.common");
        $this->language->load("products.units");
        $this->language->load("products.status");
        $this->language->load("messages.files");


        $this->_info["product"]           = $product;
        $this->_info["categories"] = ProductCategoriesModel::getAll();

        $this->_info["units"]       = $this->getClassValuesProperties(new Units());
        $this->_info["status"]       = $this->getClassValuesProperties(new StatusProduct());

        if (isset($_POST["edit"])  && $this->isAppropriate($this->_rolesValid, $_POST)) {
            $this->setProperties($product);

            if ($product->save()) {
                $this->setMessage("message_edit_success", [$product->Name]);
            } else {
                $this->setMessage( "message_edit_field", [$product->Name], Messenger::MESSAGE_DANGER);
            }

            $this->redirect("/products");
        }


        $this->_renderView();
    }

    public function deleteAction()
    {
        $id = $this->_params[0];
        $product = ProductModel::getByPK($id);

        if (! $product) {
            $this->redirect("/products");
        }
        $this->language->load("products.messages");


        if($product->delete()) {
            $this->removeImage($product);
            $this->setMessage("message_delete_product_success", [$product->Name] );
        } else {
            $this->setMessage("message_delete_product_fail", [$product->Name],  Messenger::MESSAGE_DANGER);
        }
        $this->redirect("/products");

    }

}