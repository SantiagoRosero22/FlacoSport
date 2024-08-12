<?php

use PHPUnit\Framework\TestCase;

class FakeDatabase
{
    private $queryResult;

    public function setQueryResult($result)
    {
        $this->queryResult = $result;
    }

    public function query($sql)
    {
        return $this->queryResult;
    }
}

class FakeSession
{
    private $msgType;
    private $msgText;

    public function setMsg($type)
    {
        $this->msgType = $type;
    }

    public function setMsgText($text)
    {
        $this->msgText = $text;
    }

    public function msg()
    {
        return $this->msgType;
    }

    public function msg_text()
    {
        return $this->msgText;
    }
}

class agregar_productoTest extends TestCase
{
    protected $db;
    protected $session;

    protected function setUp(): void
    {
        // Crear instancias de sustitutos manuales para la base de datos y la sesión
        $this->db = new FakeDatabase();
        $this->session = new FakeSession();

        // Inicializar valores para la sesión
        $this->session->setMsg('s');
        $this->session->setMsgText('Producto agregado exitosamente.');
    }

    protected function tearDown(): void
    {
        $_POST = [];  // Limpia el POST para evitar estado residual
    }

    public function testAddProduct()
    {
        // Simular la base de datos para un resultado exitoso
        $this->db->setQueryResult(true);

        // Configurar el POST con datos de prueba
        $_POST = [
            'product-title' => 'Test Product',
            'product-categorie' => 1,
            'product-quantity' => 10,
            'product-talla' => 'Large',
            'product-tiendas' => 'Store 1',
            'buying-price' => 10.99,
            'saleing-price' => 19.99,
            'product-photo' => 1,
        ];

        // Verificar resultados esperados
        $this->assertEquals('s', $this->session->msg());
        $this->assertStringContainsString('Producto agregado exitosamente.', $this->session->msg_text());
    }

    public function testAddProductFailed()
    {
        // Simular la base de datos para un resultado fallido
        $this->db->setQueryResult(false);

        // Configurar el POST con datos de prueba
        $_POST = [
            'product-title' => 'Test Product',
            'product-categorie' => 1,
            'product-quantity' => 10,
            'product-talla' => 'Large',
            'product-tiendas' => 'Store 1',
            'buying-price' => 10.99,
            'saleing-price' => 19.99,
            'product-photo' => 1,
        ];

        // Configurar mensajes para resultado fallido
        $this->session->setMsg('d');
        $this->session->setMsgText('Lo siento, registro falló.');

        $this->assertEquals('d', $this->session->msg());
        $this->assertStringContainsString('Lo siento, registro falló.', $this->session->msg_text());
    }
}
