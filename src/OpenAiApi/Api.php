<?php
/**
 * @author itQuelle.de
 */

namespace OpenAIApi;

class Api{

    public string $apiUrl = "https://api.openai.com/v1/completions";
    public string $secretKey = "";

    // Settings
    public array|object $response = [];
    public string $optionModel = "text-davinci-003";
    public float $optionTemperature = 0.3;
    public float $optionMaxTokens = 100;
    public float $optionTopT = 1.0;
    public float $optionFrequencyPenalty = 0.0;
    public float $optionPresencePenalty = 0.0;
    public string $prompt = "Translate this into 1.English, 2.French: Hallo";

    /**
     * @param string $secretKey | Secret key from Openai.com
     */
    public function __construct(string $secretKey){
        $this->secretKey = $secretKey;
    }

    public function httpRequest(){

        $authorization = "Authorization: Bearer " . $this->secretKey;

        $post = json_encode([
            "model"             => $this->getOptionModel(),
            "prompt"            => $this->getPrompt(),
            "temperature"       => $this->getOptionTemperature(),
            "max_tokens"        => $this->getOptionMaxTokens(),
            "top_p"             => $this->getOptionTopT(),
            "frequency_penalty" => $this->getOptionFrequencyPenalty(),
            "presence_penalty"  => $this->getOptionPresencePenalty()
        ]);

        #header('Content-Type: application/json');
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);

    }

    public function get(){

        if(!empty($this->getPrompt())) {
            $this->response = $this->httpRequest();
        }

    }

    public function getResponseRaw(): object|array{
        if(!empty($this->response->error)){
            return $this->response->error;
        }
        return $this->response;
    }
    public function getResponseText(){
        if(!empty($this->response->error)){
            return $this->response->error->message;
        }
        return $this->response->choices[0]->text;
    }

    /**
     * @return string
     */
    public function getOptionModel(): string
    {
        return $this->optionModel;
    }

    /**
     * @param string $optionModel
     */
    public function setOptionModel(string $optionModel): void
    {
        $this->optionModel = $optionModel;
    }

    /**
     * @return float
     */
    public function getOptionTemperature(): float
    {
        return $this->optionTemperature;
    }

    /**
     * @param float $optionTemperature
     */
    public function setOptionTemperature(float $optionTemperature): void
    {
        $this->optionTemperature = $optionTemperature;
    }

    /**
     * @return float|int
     */
    public function getOptionMaxTokens(): float|int
    {
        return $this->optionMaxTokens;
    }

    /**
     * @param float|int $optionMaxTokens
     */
    public function setOptionMaxTokens(float|int $optionMaxTokens): void
    {
        $this->optionMaxTokens = $optionMaxTokens;
    }

    /**
     * @return float
     */
    public function getOptionTopT(): float
    {
        return $this->optionTopT;
    }

    /**
     * @param float $optionTopT
     */
    public function setOptionTopT(float $optionTopT): void
    {
        $this->optionTopT = $optionTopT;
    }

    /**
     * @return float
     */
    public function getOptionFrequencyPenalty(): float
    {
        return $this->optionFrequencyPenalty;
    }

    /**
     * @param float $optionFrequencyPenalty
     */
    public function setOptionFrequencyPenalty(float $optionFrequencyPenalty): void
    {
        $this->optionFrequencyPenalty = $optionFrequencyPenalty;
    }

    /**
     * @return float
     */
    public function getOptionPresencePenalty(): float
    {
        return $this->optionPresencePenalty;
    }

    /**
     * @param float $optionPresencePenalty
     */
    public function setOptionPresencePenalty(float $optionPresencePenalty): void
    {
        $this->optionPresencePenalty = $optionPresencePenalty;
    }

    /**
     * @return string
     */
    public function getPrompt(): string
    {
        return $this->prompt;
    }

    /**
     * @param string $prompt
     */
    public function setPrompt(string $prompt): void
    {
        $this->prompt = $prompt;
    }

}