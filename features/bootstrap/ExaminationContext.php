<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Mink\Driver\Selenium2Driver;
use \SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;

class ExaminationContext extends PageObjectContext
{
    public function __construct(array $parameters)
    {

    }

    /**
     * @Then /^I select a History of Blurred Vision, Mild Severity, Onset (\d+) Week, Left Eye, (\d+) Week$/
     */
    public function iSelectAHistoryOfBlurredVision()
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->history();
    }

    /**
     * @Given /^I choose to expand the Comorbidities section$/
     */
    public function iChooseToExpandTheComorbiditiesSection()
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->openComorbidities();
    }

    /**
     * @Then /^I Add a Comorbiditiy of "([^"]*)"$/
     */
    public function iAddAComorbiditiyOf($com)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->addComorbiditiy($com);
    }

    /**
     * @Then /^I choose to expand the Visual Acuity section$/
     */
    public function iChooseToExpandTheVisualAcuitySection()
    {
        /**
         * @var Examination $examination
         */
        $examination = $this->getPage('Examination');
        $examination->openVisualAcuity();

    }

    /**
     * @Given /^I select a Visual Acuity of "([^"]*)"$/
     */
    public function iSelectAVisualAcuityOf($unit)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->selectVisualAcuity($unit);

    }

    /**
     * @Then /^I choose a left Visual Acuity Snellen Metre "([^"]*)" and a reading method of "([^"]*)"$/
     */
    public function SnellenMetreAndAReading($metre, $method)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->leftVisualAcuity($metre, $method);
    }

    /**
     * @Then /^I choose a right Visual Acuity Snellen Metre "([^"]*)" and a reading method of "([^"]*)"$/
     */
    public function RightVisualAcuitySnellenMetre($metre, $method)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->rightVisualAcuity($metre, $method);
    }

    /**
     * @Then /^I choose to expand the Intraocular Pressure section$/
     */
    public function iChooseToExpandTheIntraocularPressureSection()
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->expandIntraocularPressure();
    }

    /**
     * @Then /^I choose a left Intraocular Pressure of "([^"]*)" and Instrument "([^"]*)"$/
     */
    public function iChooseALeftIntraocularPressureOfAndInstrument($pressure, $instrument)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->leftIntracocular($pressure, $instrument);
    }

    /**
     * @Then /^I choose a right Intraocular Pressure of "([^"]*)" and Instrument "([^"]*)"$/
     */
    public function iChooseARightIntraocularPressureOfAndInstrument($pressure, $instrument)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->rightIntracocular($pressure, $instrument);
    }

    /**
     * @Then /^I choose to expand the Dilation section$/
     */
    public function iChooseToExpandTheDilationSection()
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
    }

    /**
     * @Then /^I choose left Dilation of "([^"]*)" and drops of "([^"]*)"$/
     */
    public function iChooseLeftDilationOfAndDropsOf($dilation, $drops)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
    }

    /**
     * @Then /^I choose right Dilation of "([^"]*)" and drops of "([^"]*)"$/
     */
    public function iChooseRightDilationOfAndDropsOf($dilation, $drops)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
    }

    /**
     * @Then /^I choose to expand the Refraction section$/
     */
    public function iChooseToExpandTheRefractionSection()
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
    }

    /**
     * @Then /^I enter left Refraction details of Sphere "([^"]*)" integer "([^"]*)" fraction "([^"]*)"$/
     */
    public function LeftRefractionDetails($sphere, $integer, $fraction)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->leftRefractionDetails($sphere, $integer, $fraction);
    }

    /**
     * @Given /^I enter left cylinder details of of Cylinder "([^"]*)" integer "([^"]*)" fraction "([^"]*)"$/
     */
    public function iEnterLeftCylinderDetails($cylinder, $integer, $fraction)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->leftCyclinderDetails($cylinder, $integer, $fraction);
    }

    /**
     * @Then /^I enter left Axis degrees of "([^"]*)"$/
     */
    public function iEnterLeftAxisDegreesOf($axis)
    {
        //We need a Clear Field function here
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->leftAxis($axis);
        //We need to Press the tab key here
    }

    /**
     * @Given /^I enter a left type of "([^"]*)"$/
     */
    public function iEnterALeftTypeOf($type)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->leftType($type);
    }

    /**
     * @Then /^I enter right Refraction details of Sphere "([^"]*)" integer "([^"]*)" fraction "([^"]*)"$/
     */
    public function iEnterRightRefractionDetailsOfSphereIntegerFraction($sphere, $integer, $fraction)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->RightRefractionDetails($sphere, $integer, $fraction);
    }

    /**
     * @Given /^I enter right cylinder details of of Cylinder "([^"]*)" integer "([^"]*)" fraction "([^"]*)"$/
     */
    public function iEnterRightCylinderDetailsOfOfCylinderIntegerFraction($cylinder, $integer, $fraction)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->RightCyclinderDetails($cylinder, $integer, $fraction);
    }

    /**
     * @Then /^I enter right Axis degrees of "([^"]*)"$/
     */
    public function iEnterRightAxisDegreesOf($axis)
    {
        //We need a Clear Field function here
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->RightAxis($axis);
        //We need to Press the tab key here
    }

    /**
     * @Given /^I enter a right type of "([^"]*)"$/
     */
    public function iEnterARightTypeOf($type)
    {
        /**
         * @var Examination $examination
         */
        $examination= $this->getPage('Examination');
        $examination->RightType($type);
    }

//    /**
//     * @Then /^I choose to expand the Gonioscopy section$/
//     */
//    public function iChooseToExpandTheGonioscopySection()
//    {
//        $this->clickLink(Examination::$expandGonioscopy);
//    }
//
//    /**
//     * @Then /^I choose to expand the Adnexal Comorbidity section$/
//     */
//    public function iChooseToExpandTheAdnexalComorbiditySection()
//    {
//        $this->clickLink(Examination::$expandaAdnexalComorbidity);
//    }
//
//    /**
//     * @Then /^I choose to expand the Anterior Segment section$/
//     */
//    public function iChooseToExpandTheAnteriorSegmentSection()
//    {
//        $this->clickLink(Examination::$expandAnteriorSegment);
//    }
//
//    /**
//     * @Then /^I choose to expand the Pupillary Abnormalities section$/
//     */
//    public function iChooseToExpandThePupillaryAbnormalitiesSection()
//    {
//        $this->clickLink(Examination::$expandPupillaryAbnormalities);
//    }
//
//    /**
//     * @Then /^I choose to expand the Optic Disc section$/
//     */
//    public function iChooseToExpandTheOpticDiscSection()
//    {
//        $this->clickLink(Examination::$expandOpticDisc);
//    }
//
//    /**
//     * @Then /^I choose to expand the Posterior Pole section$/
//     */
//    public function iChooseToExpandThePosteriorPoleSection()
//    {
//        $this->clickLink(Examination::$expandPosteriorPole);
//    }
//
//    /**
//     * @Then /^I choose to expand the Diagnoses section$/
//     */
//    public function iChooseToExpandTheDiagnosesSection()
//    {
//        $this->clickLink(Examination::$expandDiagnoses);
//    }
//
//    /**
//     * @Then /^I choose to expand the Investigation section$/
//     */
//    public function iChooseToExpandTheInvestigationSection()
//    {
//        $this->clickLink(Examination::$expandInvestigation);
//    }
//
//    /**
//     * @Then /^I choose to expand the Clinical Management section$/
//     */
//    public function iChooseToExpandTheClinicalManagementSection()
//    {
//        $this->clickLink(Examination::$expandClinicalManagement);
//    }
//
//    /**
//     * @Then /^I choose to expand the Risks section$/
//     */
//    public function iChooseToExpandTheRisksSection()
//    {
//        $this->clickLink(Examination::$expandRisks);
//    }
//
//    /**
//     * @Then /^I choose to expand the Clinic Outcome section$/
//     */
//    public function iChooseToExpandTheClinicOutcomeSection()
//    {
//        $this->clickLink(Examination::$expandClinicOutcome);
//    }
//
//    /**
//     * @Then /^I choose to expand the Conclusion section$/
//     */
//    public function iChooseToExpandTheConclusionSection()
//    {
//        $this->clickLink(Examination::$expandConclusion);
//    }
//
//    /**
//     * @Then /^I Save the Examination$/
//     */
//    public function iSaveTheExamination()
//    {
//        $this->clickLink(Examination::$saveExamination);
//    }
}