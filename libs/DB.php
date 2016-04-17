<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'config/database.php';

/*
* Classe de manipulação do Banco de Dados.
*/

class DB 
{
    
    private static $db =  NULL;
    /**
     * Abre a conexão com o banco de dados.
     */
    private static function conectar()
    {
        try
        {
            self::$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch ( PDOException $e )
        {
            echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
        }        
    }   
    
    public static function query($sql)
    {
        self::conectar();
		
        try
        {
            $result = self::$db->query($sql);
            
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) 
        {
            $mensagem = '<br /> Erro ao realizar a consulta dos dados.'
                    . '<br /> <br /> <strong>Entre em contato com o Suporte!</strong>'
                    . '<br /> <br />'
                    . '<strong>Mensagem do erro:</strong> <i>' . $e->getMessage() . '</i>';
            
            echo fnalerta('danger', $mensagem);
            
            exit;
        }
    }
    
    /**
     * Selecione uma ou mais linhas na tabela.
     * 
     * @param type $tabela
     * @param array $where
     */
    public static function selecionar($tabela, array $where, array $campos = NULL)
    {
        self::conectar();       
        
        $where_keys = array_keys($where);
        $where_values = array_values($where);
        
        $condition = ' WHERE ' . key($where) . ' = ?';
        
        array_shift($where_keys);
        
        foreach($where_keys as $k) {
            $condition .= ' AND ' . $k . ' = ?';
        }                
        
        $sql = 'SELECT ' . (count($campos) > 0? implode(', ', $campos) : '*') . ' FROM ' . $tabela . $condition;

        $stmt = self::$db->prepare($sql);
        $stmt->execute($where_values);   
		
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    
    /**
     * Seleciona todas as linhas da tabela.
     * 
     * @param type $tabela
     */
    public static function selecionarTodos($tabela)
    {
        self::conectar();
		
        try
        {
            $result = self::$db->query('SELECT * FROM ' . $tabela);
            
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) 
        {
            $mensagem = '<br /> Erro ao realizar a consulta dos dados.'
                    . '<br /> <br /> <strong>Entre em contato com o Suporte!</strong>'
                    . '<br /> <br />'
                    . '<strong>Mensagem do erro:</strong> <i>' . $e->getMessage() . '</i>';
            
            echo fnalerta('danger', $mensagem, false);
            
            exit;
        }
    }
    
    public static function inserir($tabela, array $campos, array $valores)
    {
        self::conectar();
        
        $sql = 'INSERT INTO ' . $tabela . '(' . implode(',', $campos). ')';
        $sql .= ' VALUES (';
        foreach ($valores as $valor) {
            $sql .= '?,';
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ')';

        //exit($sql);
        
        try
        {
            $stmt = self::$db->prepare($sql);
            $stmt->execute($valores); 
            
            return TRUE;
        } catch (Exception $e) {
            
            return FALSE;
        }
        
    }
    
    public static function atualizar($tabela, array $campos, array $valores, array $where)
    {
        self::conectar();       
        
        $sql = 'UPDATE ' . $tabela . ' SET';
        
        foreach($campos as $campo) {
            $sql .= ' ' . $campo . ' = ?,';
        }
        
        $sql = substr($sql, 0 , strlen($sql) - 1);
        
        
        $where_values = array_values($where);
        
        reset($where);
        
        $sql .= ' WHERE ' . key($where) . ' = ?';
        
        array_shift($where);
        
        foreach($where as $k => $v) {
            $sql .= ' AND ' . $k . ' = ?';
        }
        
        $binds = array_merge($valores, $where_values); 

        try
        {
            $stmt = self::$db->prepare($sql);
            $stmt->execute($binds);   
            
            return TRUE;
        }
	catch(PDOException $e){
            return FALSE;
        }

    }
    
    public static function excluir($tabela, array $where)
    {
        self::conectar();
        
        $sql = 'DELETE FROM ' . $tabela ;
        $sql .= ' WHERE ' . key($where) . ' = ?';
        
        $binds = array_values($where);
        
        reset($where);
        
        array_shift($where);
        
        foreach($where as $k => $v) {
            $sql .= ' AND ' . $k . ' = ?';
        }

        try
        {
            $stmt = self::$db->prepare($sql);
            $stmt->execute($binds);   
            
            return TRUE;
        }
	catch(PDOException $e){
            return FALSE;
        }
    }
}