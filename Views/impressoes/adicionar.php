<h2>Solicitar Impressão</h2>

<form method="post" enctype="multipart/form-data" name="impressoes/adicionar" id="impressao_add">
    <input type="file" name="impressao_arquivo" required /><br>
    <label for="impressao_descricao">Descrição (opcional): </label><br>
    <textarea name="impressao_descricao" id="impressao_descricao" cols="30" rows="10"></textarea><br>
    <input type="checkbox" name="impressao_ampliada" />
    <label for="ampliada">Impressão Ampliada</label><br>
    <input type="checkbox" name="impressao_braille" />
    <label for="braille">Impressão em Braille</label><br><br>
    <button  type="submit" name="form_submit" class="form_submit">Solicitar</button>
</form>