<?php
use App\Http\Controllers\InterestsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InterestsControllerTest extends TestCase
{
    protected $interestController;
    protected $validEmail = 'nr_steven.fitzgerald@csun.edu';
    protected $invalidEmail = 'Invalid@Email.edu';

    public function setUp(){
        parent::setUp();
        $this->interestController = new InterestsController;
    }

    public function testGetAllInterests_return_all_interests()
    {
        $data = $this->call('GET', 'api/1.0/interests');
        $content = json_decode($data->content(), true);
        $this->assertEquals($content['count'],1819);
        $this->assertEquals($content['count'],count($content['interests']));
        $this->assertEquals($content['status'],200);
    }
    public function testGetAllInterests_return_persons_interests()
    {
        $data = $this->call('GET', 'api/1.0/interests?email='.$this->validEmail);
        $content = json_decode($data->content(), true);
        $this->assertEquals($content['count'],7);
        $this->assertEquals($content['count'],count($content['interests']));
        $this->assertEquals($content['status'],200);
    }


    public function testGetPersonsAcademicInterests_returns_all_persons_academic_interests()
    {
        $data = $this->interestController->getPersonsAcademicInterests('nr_jeffrey.wiegley@csun.edu');
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],1);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
    public function testGetPersonsAcademicInterests_throws_NotFoundHttpException(){
        $this->setExpectedException(NotFoundHttpException::class);
        $this->interestController->getPersonsAcademicInterests($this->invalidEmail);
    }

    public function testGetPersonsPersonalInterests_returns_all_persons_personal_interests()
    {
        $data = $this->interestController->getPersonsPersonalInterests('nr_jeffrey.wiegley@csun.edu');
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],8);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
    public function testGetPersonsPersonalInterests_throws_NotFoundHttpException(){
        $this->setExpectedException(NotFoundHttpException::class);
        $this->interestController->getPersonsPersonalInterests($this->invalidEmail);
    }

    public function testGetPersonsResearchInterests_returns_all_persons_research_interests(){
        $data = $this->interestController->getPersonsResearchInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],7);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    public function testGetAllPersonsInterests_returns_all_persons_interests(){

        $data = $this->interestController->getAllPersonsInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],7);
        $this->assertEquals(count($content['interests']),$content['count']);
    }


    public function testGetPersonsResearchInterests_throws_NotFoundHttpException(){
       $this->setExpectedException(NotFoundHttpException::class);
       $this->interestController->getPersonsResearchInterests($this->invalidEmail);
    }

    public function testGetAllPersonsInterests_throws_NotFoundHttpException(){
        $this->setExpectedException(NotFoundHttpException::class);
        $this->interestController->getAllPersonsInterests($this->invalidEmail);

    }
   public function testGetAllResearchInterest_returns_all_research_interests(){
        $data = $this->interestController->getAllResearchInterests();
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],1307);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    public function testGetAllAcademicInterests_return_all_academic_interests()
    {
        $data = $this->interestController->getAllAcademicInterests();
        $this->assertEquals($data->status(), 200);
        $content = json_decode($data->content(), true);
        $this->assertEquals($content['count'], 3);
        $this->assertEquals(count($content['interests']), $content['count']);
    }
  public function testGetAllPersonalInterests_return_all_personal_interests(){
        $data = $this->interestController->getAllPersonalInterests();
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],511);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
}
