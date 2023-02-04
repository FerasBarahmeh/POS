<?php
namespace APP\Controllers;

use APP\Helpers\PublicHelper\PublicHelper;
use APP\LIB\FilterInput;
use APP\Models\EmployeeModel;

class EmployeeController extends AbstractController {
    use FilterInput;
    use PublicHelper;
    public function defaultAction()
    {
        $this->_language->load("employee.default");
        $this->_info["employees"] = EmployeeModel::getAll();
        $this->_renderView();
    }
    public function addAction()
    {

        $this->_language->load("employee.add");
        if (isset($_POST["add-employee"])) {
            $employee = new EmployeeModel();
            $this->prepareInfoEmployee($employee);
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $id = $this->filterInt(@$this->_params[0]);
        $employee = EmployeeModel::getByPK($id);

        if ($employee == null) {
            $this->redirect("/employee");
        }

        $this->_info["employee"] = $employee;

        if (isset($_POST["edit-employee"])) {
            $this->prepareInfoEmployee($employee);
        }
        $this->_renderView();
    }

    public function deleteAction()
    {
        $id = $this->filterInt(@$this->_params[0]);
        $employee = EmployeeModel::getByPK($id);

        if ($employee == null) {
            $this->redirect("/employee");
        }
        if ($employee->delete()) {
            $_SESSION["massage"] = "Add Employee Deleted Successfully";
            $this->redirect("/employee");
        }

    }

    /**
     * @param mixed $employee variable Container Prepare All Info employee and set Appropriate Operation
     * <p>method tack all employee information and apply appropriate operation</p>
     * @return void
     */
    private function prepareInfoEmployee(mixed &$employee): void
    {
        $employee->name     = $this->filterStr($_POST["name"]);
        $employee->age      = $this->filterInt($_POST["age"]);
        $employee->address  = $this->filterStr($_POST["address"]);
        $employee->tax      = $this->filterFloat($_POST["tax"]);
        $employee->salary   = $this->filterFloat($_POST["salary"]);

        $this->applyAppropriateOperation($employee);
    }

    private function applyAppropriateOperation(&$employee)
    {
        if ($employee->save()) {
            $_SESSION["massage"] = "Add Employee Successfully";
            $this->redirect("/employee");
        }
    }
}