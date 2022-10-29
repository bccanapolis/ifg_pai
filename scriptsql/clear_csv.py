import pandas as pd

ano_semestre ='20222'

df = pd.read_csv('./nota_aluno_202210041243.csv', low_memory=False)

head_raw = df['nome_pauta_disciplina']

head_raw = head_raw.str.split(' - ',1, expand=True).replace('\(\d*(H|h)\)', '', regex=True)
head_raw[0] = head_raw[0].str.split('.',expand=True)[0]
head_raw[1] = head_raw[1].str.replace('\n', '') # remove new line

head_raw = head_raw.rename(columns={0: 'ano_disciplina', 1: 'nome_disciplina'})

df = df.drop(columns=['nome_pauta_disciplina'])
df = pd.concat([head_raw, df], axis=1)

df = df.loc[df['ano_disciplina'].str.startswith(ano_semestre)]


# campus = df['campus'].str.replace('Câmpus ', '')

# campus = campus.unique()
# campus.sort()

# print(campus)


df.to_csv(f'./alunos_{ano_semestre}.csv', index=False)