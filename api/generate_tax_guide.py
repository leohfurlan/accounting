import sys, json, base64
#from integra_contador import IntegraContadorClient

# Parâmetros: type, competencia, value, company_id
_, guide_type, competencia, value, company_id = sys.argv
client = 1#IntegraContadorClient(api_key='SEU_API_KEY')
# Ajusta request segundo tipo de guia
request = {
    'tipo'              : guide_type,
    'competencia'       : competencia,
    'valor'             : value,
    'cnpj_cpf_empresa'  : company_id,
    'banco'             : '010'
}
resp = client.generate_guide(**request)
# Espera resp: {'pdf_base64':'...', 'numero':'0001'}

# Salva PDF no servidor
pdf_dir = 'modules/accounting/generated_guides'
#Path(pdf_dir).mkdir(parents=True, exist_ok=True)
pdf_path = f"{pdf_dir}/guide_{resp['numero']}.pdf"
with open(pdf_path, 'wb') as f:
    f.write(base64.b64decode(resp['pdf_base64']))
print(json.dumps({'pdf_path': pdf_path}))