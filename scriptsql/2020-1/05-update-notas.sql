alter table notas_disciplina add column ano int;
alter table notas_disciplina add column semestre int;

update notas_disciplina set ano=2019, semestre=2 where ano is NULL;