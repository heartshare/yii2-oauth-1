<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivantree
 * Date: 14-10-14
 * Time: 下午2:15
 * To change this template use File | Settings | File Templates.
 */
namespace ivantree\oauth;

use Yii;
use yii\helpers\Html;

class AuthChoice extends \yii\authclient\widgets\AuthChoice
{
    /**
     * @var string the title of auth client list
     */
    public $title = '';

    /**
     * @var bool  description of auth-client
     */
    public $isAuthDescription = false;

    /**
     * @var string css icon of auth client
     */
    public $authClientCss = 'fa ';
    /**
     * Outputs client auth link.
     * @param ClientInterface $client external auth client instance.
     * @param string $text link text, if not set - default value will be generated.
     * @param array $htmlOptions link HTML options.
     */
    public function clientLink($client, $text = null, array $htmlOptions = [])
    {
        if ($text === null) {
            $text = Html::tag('i', '', ['class' =>  $this->authClientCss . ' icon-' . strtolower($client->getName())]);
            if($this->isAuthDescription){
                $text .= Html::tag('span', Yii::t('app',$client->getTitle()), ['class' => 'auth-title']);
            }
            $htmlOptions['title'] = Yii::t('app',$client->getTitle());
        }
        if (!array_key_exists('class', $htmlOptions)) {
            $htmlOptions['class'] = $client->getName();
        }
        if ($this->popupMode) {
            $viewOptions = $client->getViewOptions();
            if (isset($viewOptions['popupWidth'])) {
                $htmlOptions['data-popup-width'] = $viewOptions['popupWidth'];
            }
            if (isset($viewOptions['popupHeight'])) {
                $htmlOptions['data-popup-height'] = $viewOptions['popupHeight'];
            }
        }
        echo Html::a($text, $this->createClientUrl($client), $htmlOptions);
    }

    /**
     * Renders the main content, which includes all external services links.
     */
    protected function renderMainContent()
    {
        //echo Html::beginTag('ul', ['class' => 'auth-clients']);
        if($this->title != '') echo html::tag('h3',$this->title);
        foreach ($this->getClients() as $externalService) {
            echo Html::beginTag('div', ['class' => 'auth-client']);
            $this->clientLink($externalService);
            echo Html::endTag('div');
        }
        //echo Html::endTag('ul');
    }

}
