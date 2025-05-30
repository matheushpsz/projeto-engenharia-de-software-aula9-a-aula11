<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Product;//importa o do model Product para usar nas rotas
use App\Models\Category; // importa o model Category para usar nas rotas
use App\Models\Company; // importa o model Company para usar nas rotas
use App\Models\Person; // importa o model Person para usar nas rotas
use App\Models\BirthCertificate; // importa o model BirthCertificate para usar nas rotas

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//------------------------------------------------------------------
// rota do tipo post resposavel por criar um novo produto
Route::post('/products', function (Request $request) {
    $product = new Product(); // cria uma nova instância do modelo Product

    $product->name = $request->input('name'); // define o nome do produto
    $product->price = $request->input('price'); // define o preço do produto
    $product->description = $request->input('description'); // define a descrição do produto
    $product->category_id = $request->input('category_id'); // <-- Adicione esta linha
    $product->save(); // salva o produto no banco de dados
    
    return response()->json([
        'message' => 'Produto criado com sucesso!',
        'product' => $product
    ], 201); // retorna mensagem de sucesso e o produto criado
});
/*
 utilizando postman para validar o endpoint:
    1 - ligue o servidor com o comando: php artisan serve no terminal
    2 - no postman, crie uma requisição do tipo POST com endereço + o endpoint: http://127.0.0.1:8000/api/products
    3 - selecione body, em seguida a opção raw e escolha o formato JSON e adicione o seguinte conteúdo:
        {
            "name": "Product 1",
            "price": 10.99,
            "description": "Description for Product 1"
        }
    4- clique em send e verifique a resposta
*/
//------------------------------------------------------------------
Route::post('/categories', function (Request $request) {
    $category =  new Category(); 

    $category->name = $request->input('name'); 
    $category->description = $request->input('description'); 
    $category->save(); // salva a categoria no banco de dados
    
    return response()->json([
        'message' => 'Categoria criada com sucesso!',
        'category' => $category
    ], 201); 
});
//rota para listar todos os produtos
Route::get('/products', function () {
    $products = Product::all(); // busca todos os produtos no banco de dados
    return response()->json($products); // retorna os produtos em formato JSON
});
//rota para listar todas as categorias
Route::get('/categories', function () {
    $categories = Category::all(); 
    return response()->json($categories); 
});
//rota para buscar um produto específico pelo ID
Route::get('/products/{id}', function ($id) {
    $product = Product::find($id); // busca o produto pelo ID
    if (!$product) {
        return response()->json(['message' => 'Produto não encontrado'], 404); // retorna erro 404 se não encontrar
    }
    return response()->json($product); // retorna o produto em formato JSON
});
//rota para buscar uma categoria específica pelo ID
Route::get('/categories/{id}', function ($id) {
    $category = Category::find($id); // busca a categoria pelo ID
    if (!$category) {
        return response()->json(['message' => 'Categoria não encontrada'], 404); // retorna erro 404 se não encontrar
    }
    return response()->json($category); // retorna a categoria em formato JSON
});


//atualizando registo parcialmente de um produto
Route::patch('/products/{id}', function (Request $request, $id) {
    $product = Product::find($id); // busca o produto pelo ID
    if (!$product) {
        return response()->json(['message' => 'Produto não encontrado'], 404); // retorna erro 404 se não encontrar
    }

    // Atualiza os campos do produto com os dados fornecidos na requisição
    $product->name = $request->input('name', $product->name);
    $product->price = $request->input('price', $product->price);
    $product->description = $request->input('description', $product->description);
    $product->save(); // salva as alterações no banco de dados

    return response()->json([
        'message' => 'Produto atualizado com sucesso!',
        'product' => $product
    ]);
});
//atualizando registo parcialmente de uma categoria
Route::patch('/categories/{id}', function (Request $request, $id) {
    $category = Category::find($id); // busca a categoria pelo ID
    if (!$category) {
        return response()->json(['message' => 'Categoria não encontrada'], 404); // retorna erro 404 se não encontrar
    }

    // Atualiza os campos da categoria com os dados fornecidos na requisição
    $category->name = $request->input('name', $category->name);
    $category->description = $request->input('description', $category->description);
    $category->save(); // salva as alterações no banco de dados

    return response()->json([
        'message' => 'Categoria atualizada com sucesso!',
        'category' => $category
    ]);
});
//rota para deletar um produto pelo ID
Route::delete('/products/{id}', function ($id) {
    $product = Product::find($id); // busca o produto pelo ID
    if (!$product) {
        return response()->json(['message' => 'Produto não encontrado'], 404); // retorna erro 404 se não encontrar
    }
    $product->delete(); // deleta o produto do banco de dados
    return response()->json(['message' => 'Produto deletado com sucesso']); // retorna mensagem de sucesso
});
//rota para deletar uma categoria pelo ID
Route::delete('/categories/{id}', function ($id) {
    $category = Category::find($id); // busca a categoria pelo ID
    if (!$category) {
        return response()->json(['message' => 'Categoria não encontrada'], 404); // retorna erro 404 se não encontrar
    }
    $category->delete(); // deleta a categoria do banco de dados
    return response()->json(['message' => 'Categoria deletada com sucesso']); // retorna mensagem de sucesso
});
//-------------------------------------------------
/*
Crie uma API para Gerenciar Empresas
 ● Uma empresa deve conter Razão Social, Nome Fantasia e CNPJ
 ● Deve ser possível:
    ○ Criar
    ○ Buscar uma empresa pelo Id
    ○ Listar todas
    ○ Apagar uma empresa
*/
//rota para criar uma nova empresa
Route::post('/companies', function (Request $request) {
    $company = new Company(); 

    $company->legal_name = $request->input('legal_name'); 
    $company->fantasy_name = $request->input('fantasy_name');
    $company->cnpj = $request->input('cnpj'); 
    $company->save(); 
    
    return response()->json([
        'message' => 'Empresa criada com sucesso!',
        'company' => $company
    ], 201); 
});
//buscar uma empresa específica pelo ID
Route::get('/companies/{id}', function ($id) {
    $company = Company::find($id); 
    if (!$company) {
        return response()->json(['message' => 'Empresa não encontrada'], 404); 
    }
    return response()->json($company); // retorna a empresa em formato JSON
});
//rota para listar todas as empresas
Route::get('/companies', function () {
    $companies = Company::all(); 
    return response()->json($companies); 
});
//rota para deletar uma empresa pelo ID
Route::delete('/companies/{id}', function ($id) {
    $company = Company::find($id); 
    if (!$company) {
        return response()->json(['message' => 'Empresa não encontrada'], 404); 
    }
    $company->delete(); 
    return response()->json(['message' => 'Empresa deletada com sucesso']); 
});
//--------------------------------------------------
//atividade aula 10 slide  11
//Rota para criar uma nova pessoa
Route::post('/people', function (Request $request) {
    $person = new Person(); 

    $person->cpf = $request->input('cpf'); 
    $person->name = $request->input('name'); 
    $person->rg = $request->input('rg'); 
    $person->birth_date = $request->input('birth_date'); 
    $person->save(); 
    
    return response()->json([
        'message' => 'Pessoa criada com sucesso!',
        'person' => $person
    ], 201); 
});
//Rota para criar certidão de nascimento
Route::post('/birth-certificates', function (Request $request) {
    $birthCertificate = new BirthCertificate(); 

    $birthCertificate->registration_number = $request->input('registration_number'); 
    $birthCertificate->issue_date = $request->input('issue_date'); 
    $birthCertificate->place_of_birth = $request->input('place_of_birth'); 
    $birthCertificate->person_id = $request->input('person_id'); // define a pessoa associada à certidão
    $birthCertificate->save(); 
    
    return response()->json([
        'message' => 'Certidão de nascimento criada com sucesso!',
        'birth_certificate' => $birthCertificate
    ], 201); 
});
//Rota para listar todas as pessoas
Route::get('/people', function () {
    $people = Person::all(); // busca todas as pessoas no banco de dados
    return response()->json($people); // retorna as pessoas em formato JSON
});
//Rota para listar todas as certidões de nascimento
Route::get('/birth-certificates', function () {
    $birthCertificates = BirthCertificate::all(); // busca todas as certidões de nascimento no banco de dados
    return response()->json($birthCertificates); // retorna as certidões em formato JSON
});
//Rota para buscar uma pessoa específica pelo ID
Route::get('/people/{id}', function ($id) {
    $person = Person::find($id); // busca a pessoa pelo ID
    if (!$person) {
        return response()->json(['message' => 'Pessoa não encontrada'], 404); // retorna erro 404 se não encontrar
    }
    return response()->json($person); // retorna a pessoa em formato JSON
});
//Rota para buscar uma certidão de nascimento específica pelo ID
Route::get('/birth-certificates/{id}', function ($id) {
    $birthCertificate = BirthCertificate::find($id); // busca a certidão de nascimento pelo ID
    if (!$birthCertificate) {
        return response()->json(['message' => 'Certidão de nascimento não encontrada'], 404); // retorna erro 404 se não encontrar
    }
    return response()->json($birthCertificate); // retorna a certidão em formato JSON
});

//deletar pessoa pelo ID
Route::delete('/people/{id}', function ($id) {
    $person = Person::find($id); // busca a pessoa pelo ID
    if (!$person) {
        return response()->json(['message' => 'Pessoa não encontrada'], 404); // retorna erro 404 se não encontrar
    }
    $person->delete(); // deleta a pessoa do banco de dados
    return response()->json(['message' => 'Pessoa deletada com sucesso']); // retorna mensagem de sucesso
});