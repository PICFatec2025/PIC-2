<form method="POST" action="{{ route('task.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Título">
    <br>
    <select name="completed">
        <option value="0">Não</option>
        <option value="1">Sim</option>
    </select>
    <br>
    <button type="submit">Cadastrar</button>
</form>