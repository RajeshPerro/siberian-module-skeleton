<?php
/**
 * Class Job_Form_Place
 */
class Job_Form_Place extends Siberian_Form_Abstract {

    public function init() {
        parent::init();

        $db = Zend_Db_Table::getDefaultAdapter();

        $this
            ->setAction(__path("/job/place/editpost"))
            ->setAttrib("id", "form-place")
            ->addNav("job-place-nav");
        ;

        /** Bind as a create form */
        self::addClass("create", $this);

        $this->addSimpleHidden("place_id");

        $logo = $this->addSimpleImage("banner", __("Header"), __("Import a header image"), array("width" => 1200, "height" => 400, "required" => true));

        $name = $this->addSimpleText("name", __("Name"));
        $name
            ->setRequired(true)
        ;

        $description = $this->addSimpleTextarea("description", __("Description"));
        $description
            ->setRequired(true)
            ->setNewDesignLarge()
            ->setRichtext()
        ;


        $address = $this->addSimpleText("location", __("Address"));
        $address
            ->setRequired(true)
        ;

        $company = $this->addSimpleSelect("company_id", __("Company"));
        $company->setRequired(true);

        $select_company = $db->select()
            ->from('job_company')
            ->where('job_company.company_id = :value')
        ;
        $company->addValidator("Db_RecordExists", true, $select_company);
        $company->setRegisterInArrayValidator(false);

        $category = $this->addSimpleSelect("category_id", __("Category"));

        $select_category = $db->select()
            ->from('job_category')
            ->where('job_category.category_id = :value')
        ;
        $category->addValidator("Db_RecordExists", true, $select_category);
        $category->setRegisterInArrayValidator(false);

        $contract_type = $this->addSimpleText("contract_type", __("Contract type"));
        $income_from = $this->addSimpleText("income_from", __("Income from:"));
        $income_to = $this->addSimpleText("income_to", __("to:"));

        $keywords = $this->addSimpleText("keywords", __("Keywords"));

        $value_id = $this->addSimpleHidden("value_id");
        $value_id
            ->setRequired(true)
        ;
    }

    public function setPlaceId($place_id) {
        $this->getElement("place_id")->setValue($place_id)->setRequired(true);
    }
}