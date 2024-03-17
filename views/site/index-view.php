<?php $this->extends('master') ?>

<div class="card">
    <div class="card-top">
        <div class="container ml-auto mr-auto">
            <div class="row">
                <div class="col-lg-6 col-12 text-white">
                    <h3 class="card-heading">Dashboard</h3>
                    <span class="">Uma visão geral dos teus dados</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="task-view task-white">
                        <span class="card-heading">Tens 5%</span>
                        <span class="d-block">Da tua média semestral</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="task-view task-white">
                        <span class="card-heading">Tens 7</span>
                        <span class="d-block">Disciplinas semestral</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="task-view task-white">
                        <span class="card-heading">Tens 7</span>
                        <span class="d-block">Disciplinas semestral</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-input" placeholder="Deixe aqui uma informação">
                        </div>
                        <div class="input-group">
                            <label for="anexo">
                                <span class="bi bi-link-45deg"></span>
                                <input type="hidden" name="">
                            </label>
                            <select name="" class="form-select">
                                <option value="">Filtrar</option>
                                <option value="all">Para todos</option>
                                <option value="own">Para minha turma</option>
                            </select>
                            <button type="submit" class="btn btn-outline-warning">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card mt-4">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <?php for ($i = 0; $i < 5; $i++) : ?>
                    <div class="col-12">
                        <div class="post-view">
                            <div class="post-owner">
                                <span class="owner">D</span>
                                <div class="owner-name">
                                    <small class="text-muted">Post informativo</small>
                                    <span class="d-block">Departamento</span>
                                    <small class="text-muted">Há 1min</small>
                                </div>
                                <span class="bi bi-three-dots-vertical"></span>
                            </div>
                            <p class="post-content">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor voluptatibus ullam officia, ipsa ducimus ut omnis, animi ea odit cupiditate mollitia necessitatibus sit nemo illo illum, soluta facere temporibus id.
                            </p>
                            <div class="post-anex">
                                <img src="" alt="">
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>