--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.17
-- Dumped by pg_dump version 12rc1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: om_pergunta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.om_pergunta (
    id integer NOT NULL,
    om_id integer,
    pergunta_id integer,
    status character varying(255) DEFAULT 'pendente'::character varying
);


ALTER TABLE public.om_pergunta OWNER TO postgres;

--
-- Name: om_pergunta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.om_pergunta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.om_pergunta_id_seq OWNER TO postgres;

--
-- Name: om_pergunta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.om_pergunta_id_seq OWNED BY public.om_pergunta.id;


--
-- Name: oms; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.oms (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    sigla character varying(100) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.oms OWNER TO postgres;

--
-- Name: oms_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.oms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.oms_id_seq OWNER TO postgres;

--
-- Name: oms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.oms_id_seq OWNED BY public.oms.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: perguntas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perguntas (
    id integer NOT NULL,
    descricao text NOT NULL,
    anexo character varying(255),
    user_id integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    status character varying(255) DEFAULT 'Ativo'::character varying
);


ALTER TABLE public.perguntas OWNER TO postgres;

--
-- Name: perguntas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.perguntas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.perguntas_id_seq OWNER TO postgres;

--
-- Name: perguntas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.perguntas_id_seq OWNED BY public.perguntas.id;


--
-- Name: respostas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respostas (
    id integer NOT NULL,
    resposta text NOT NULL,
    anexo_resposta character varying(255),
    user_id integer,
    pergunta_id integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.respostas OWNER TO postgres;

--
-- Name: respostas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.respostas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.respostas_id_seq OWNER TO postgres;

--
-- Name: respostas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.respostas_id_seq OWNED BY public.respostas.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    tipo character varying(255) DEFAULT 'usuario'::character varying NOT NULL,
    om_id integer,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    status character varying(255) DEFAULT 'pendente'::character varying
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: om_pergunta id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.om_pergunta ALTER COLUMN id SET DEFAULT nextval('public.om_pergunta_id_seq'::regclass);


--
-- Name: oms id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oms ALTER COLUMN id SET DEFAULT nextval('public.oms_id_seq'::regclass);


--
-- Name: perguntas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perguntas ALTER COLUMN id SET DEFAULT nextval('public.perguntas_id_seq'::regclass);


--
-- Name: respostas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respostas ALTER COLUMN id SET DEFAULT nextval('public.respostas_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.migrations VALUES (1, '2020_04_23_010000_create_oms_table', 1);
INSERT INTO public.migrations VALUES (2, '2020_04_23_020000_create_users_table', 1);
INSERT INTO public.migrations VALUES (3, '2020_04_23_030000_create_password_resets_table', 1);
INSERT INTO public.migrations VALUES (11, '2020_04_24_010000_create_perguntas_table', 2);
INSERT INTO public.migrations VALUES (12, '2020_04_24_020000_create_respostas_table', 2);
INSERT INTO public.migrations VALUES (13, '2020_04_29_010000_add_status_to_perguntas_table', 2);
INSERT INTO public.migrations VALUES (14, '2020_05_01_010000_create_om_pergunta_table', 2);
INSERT INTO public.migrations VALUES (15, '2020_05_05_010000_add_status_to_users_table', 3);


--
-- Data for Name: om_pergunta; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: oms; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.oms VALUES (6, '7° Batalhão de Infantaria de Selva', '7° BIS', '2020-03-27 02:08:28', '2020-03-27 02:08:28');
INSERT INTO public.oms VALUES (10, '4° Centro de Telemática de Área', '4° CTA', '2020-03-27 22:46:46', '2020-03-27 22:46:46');
INSERT INTO public.oms VALUES (12, 'Centro de Instrução de Guerra na Selva', 'CIGS', '2020-03-27 22:47:51', '2020-03-27 22:47:51');
INSERT INTO public.oms VALUES (13, 'Colégio Militar de Manaus', 'CMM', '2020-03-27 22:48:08', '2020-03-27 22:48:08');
INSERT INTO public.oms VALUES (14, 'Comissão Regional de Obras 12ª RM', 'CRO/12', '2020-03-27 22:48:50', '2020-03-27 22:48:50');
INSERT INTO public.oms VALUES (15, 'Hospital Militar de Área de Manaus', 'HMAM', '2020-03-27 22:49:21', '2020-03-27 22:49:21');
INSERT INTO public.oms VALUES (17, 'Centro de Embarcações do Comando Militar da Amazônia', 'CECMA', '2020-03-27 22:50:34', '2020-03-27 22:50:34');
INSERT INTO public.oms VALUES (25, '7° Batalhão de Polícia do Exército', '7º BPE', '2020-03-27 22:58:16', '2020-03-27 22:58:16');
INSERT INTO public.oms VALUES (33, '6º Batalhão de Engenharia de Construção', '6° BEC', '2020-03-28 00:29:25', '2020-03-28 00:29:25');
INSERT INTO public.oms VALUES (39, '5º Batalhão de Engenharia de Construção', '5° BEC', '2020-03-28 00:34:24', '2020-03-28 00:34:24');
INSERT INTO public.oms VALUES (43, '7º Batalhão de Engenharia e Construção', '7° BEC', '2020-03-28 00:38:46', '2020-03-28 00:38:46');
INSERT INTO public.oms VALUES (45, '17° Batalhão de Infantaria de Selva', '17° BIS', '2020-03-28 00:41:47', '2020-03-28 00:41:47');
INSERT INTO public.oms VALUES (49, '61º Batalhão de Infantaria de Selva', '61º BIS', '2020-03-28 00:45:07', '2020-03-28 00:45:07');
INSERT INTO public.oms VALUES (58, '2º Batalhão Logístico de Selva', '2º B LOG SL', '2020-03-28 00:55:09', '2020-03-28 00:55:09');
INSERT INTO public.oms VALUES (60, '3º Batalhão de Infantaria de Selva', '3º BIS', '2020-03-28 00:56:25', '2020-03-28 00:56:25');
INSERT INTO public.oms VALUES (61, '54° Batalhão de Infantaria de Selva', '54º BIS', '2020-03-28 00:56:56', '2020-03-28 00:56:56');
INSERT INTO public.oms VALUES (29, '32° Pelotão de Polícia do Exército', '32° Pel PE', '2020-03-28 00:27:16', '2020-05-05 15:46:58');
INSERT INTO public.oms VALUES (27, 'Compania de Comando 1ª Bda Inf Sl', 'Cia Cmdo 1ª Bda Inf Sl', '2020-03-28 00:25:15', '2020-05-05 15:43:46');
INSERT INTO public.oms VALUES (4, 'Compania de Comando 12ª RM', 'Cia Cmdo 12ªRM', '2020-03-27 00:41:31', '2020-05-05 15:40:47');
INSERT INTO public.oms VALUES (21, '12° Batalhão de Suprimento', '12° B Sup', '2020-03-27 22:54:58', '2020-05-05 15:41:08');
INSERT INTO public.oms VALUES (19, 'Parque Regional de Manutenção 12ª RM', 'Pq R Mnt/12', '2020-03-27 22:52:24', '2020-05-05 15:41:22');
INSERT INTO public.oms VALUES (40, 'Hospital de Guarnição Porto Velho', 'H Gu PV', '2020-03-28 00:34:46', '2020-05-05 15:41:59');
INSERT INTO public.oms VALUES (53, 'Hospital de Guarnição de São Gabriel da Cachoeira', 'H Gu SGC', '2020-03-28 00:49:58', '2020-05-05 15:42:11');
INSERT INTO public.oms VALUES (51, 'Hospital de Guarnição de Tabatinga', 'H Gu T', '2020-03-28 00:47:24', '2020-05-05 15:42:27');
INSERT INTO public.oms VALUES (5, '1° Batalhão de Infantaria de Selva', '1º BIS(Amv)', '2020-03-27 00:41:56', '2020-05-05 15:44:10');
INSERT INTO public.oms VALUES (31, '7º Batalhão de Infantaria de Selva', 'CFRR/7° BIS', '2020-03-28 00:28:28', '2020-05-05 15:44:56');
INSERT INTO public.oms VALUES (32, '10° Grupo de Artilharia de Campanha de Selva', '10° GAC Sl', '2020-03-28 00:29:05', '2020-05-05 15:45:21');
INSERT INTO public.oms VALUES (34, '1º Batalhão Logístico de Selva', '1ª B Log Sl', '2020-03-28 00:30:09', '2020-05-05 15:45:50');
INSERT INTO public.oms VALUES (28, '12° Esquadrão de Cavalaria Mecanizado', '12° Esqd C Mec', '2020-03-28 00:26:12', '2020-05-05 15:46:15');
INSERT INTO public.oms VALUES (30, '1º Pelotão de Comunicações de Selva', '1° Pel Com Sl', '2020-03-28 00:27:44', '2020-05-05 15:46:40');
INSERT INTO public.oms VALUES (64, 'Comando da 2ª Brigada de Infantaria de Selva', 'Cmdo 2ª Bda Inf Sl', '2020-03-28 00:48:53', '2020-05-05 15:47:53');
INSERT INTO public.oms VALUES (26, '1ª Brigada de Infantaria de Selva', 'Cmdo 1ª Bda Inf Sl', '2020-03-28 00:21:55', '2020-05-05 15:48:24');
INSERT INTO public.oms VALUES (54, 'Compania de Comando 2ª Bda Inf Sl', 'Cia Cmdo 2ª Bda Inf Sl', '2020-03-28 00:52:05', '2020-05-05 15:50:15');
INSERT INTO public.oms VALUES (57, '5º Batalhão de Infantaria de Selva', 'CFRN/5° BIS', '2020-03-28 00:54:34', '2020-05-05 16:02:43');
INSERT INTO public.oms VALUES (55, '22° Pelotão de Polícia do Exército', '22° Pel PE', '2020-03-28 00:53:12', '2020-05-05 16:03:00');
INSERT INTO public.oms VALUES (56, '2º Pelotão de Comunicações de Selva', '2° Pel Com Sl', '2020-03-28 00:54:09', '2020-05-05 16:03:30');
INSERT INTO public.oms VALUES (65, 'Comando da 16ª Brigada de Infantaria de Selva', 'Cmdo 16ª Bda Inf Sl', '2020-03-28 00:39:50', '2020-05-05 16:03:59');
INSERT INTO public.oms VALUES (44, 'Companhia de Comando 16ª Bda Inf Sl', 'Cia Cmdo 16ª Bda Inf Sl', '2020-03-28 00:40:58', '2020-05-05 16:04:22');
INSERT INTO public.oms VALUES (50, '8º Batalhão de Infantaria de Selva', 'CFSOL/8º BIS', '2020-03-28 00:45:51', '2020-05-05 16:04:41');
INSERT INTO public.oms VALUES (46, '16ª Base Logística', '16ª Ba Log', '2020-03-28 00:42:26', '2020-05-05 16:05:09');
INSERT INTO public.oms VALUES (48, '16° Pelotão de Comunicações de Selva', '16º Pel Com Sl', '2020-03-28 00:44:36', '2020-05-05 16:05:25');
INSERT INTO public.oms VALUES (47, '34º Pelotão de Polícia do Exército', '34° Pel PE', '2020-03-28 00:42:55', '2020-05-05 16:05:40');
INSERT INTO public.oms VALUES (62, 'Comando da 17ª Brigada de Infantaria de Selva', 'Cmdo 17ª Bda Inf Sl', '2020-03-28 00:31:42', '2020-05-05 16:06:12');
INSERT INTO public.oms VALUES (41, 'Companhia de Comando da 17ª Bda Inf Sl', 'Cia Cmdo 17ª Bda Inf Sl', '2020-03-28 00:35:18', '2020-05-05 16:06:22');
INSERT INTO public.oms VALUES (42, '4º Batalhão de Infantaria de Selva', 'CFAC/4° BIS', '2020-03-28 00:38:25', '2020-05-05 16:06:53');
INSERT INTO public.oms VALUES (59, '6º Batalhão de Infantaria de Selva', 'CFRO/6º BIS', '2020-03-28 00:55:48', '2020-05-05 16:07:13');
INSERT INTO public.oms VALUES (35, '17ª Companhia de Infantaria de Selva', '17ª Cia Inf Sl', '2020-03-28 00:32:30', '2020-05-05 16:07:56');
INSERT INTO public.oms VALUES (36, '17ª Base Logística', '17ª Ba Log', '2020-03-28 00:33:05', '2020-05-05 16:08:14');
INSERT INTO public.oms VALUES (37, '17º Pelotão de Polícia do Exército', '17º Pel PE', '2020-03-28 00:33:32', '2020-05-05 16:08:28');
INSERT INTO public.oms VALUES (38, '17º Pelotão de Comunicações de Selva', '17º Pel Com', '2020-03-28 00:33:58', '2020-05-05 16:08:58');
INSERT INTO public.oms VALUES (63, 'Comando do 2° Grupamento de Engenharia', 'Cmdo 2° Gpt E', '2020-03-27 22:53:53', '2020-05-05 16:10:17');
INSERT INTO public.oms VALUES (16, 'Compania de Comando 2° GPT E', 'Cia Cmdo 2° Gpt E', '2020-03-27 22:49:59', '2020-05-05 16:10:29');
INSERT INTO public.oms VALUES (66, '8º Batalhão de Engenharia de Construção', '8º BEC', '2020-05-05 16:11:49', '2020-05-05 16:11:49');
INSERT INTO public.oms VALUES (52, '21ª Companhia de Engenharia de Construção', '21ª Cia E Cnstr', '2020-03-28 00:49:35', '2020-05-05 16:12:21');
INSERT INTO public.oms VALUES (11, 'Compania de Comando CMA', 'Cia Cmdo CMA', '2020-03-27 22:47:19', '2020-05-05 16:13:18');
INSERT INTO public.oms VALUES (20, '4° Batalhão de Aviação do Exército', '4° BAvEx', '2020-03-27 22:54:26', '2020-05-05 16:14:24');
INSERT INTO public.oms VALUES (24, '1º Batalhão de Comunicações de Selva', '1º B Com Sl', '2020-03-27 22:57:46', '2020-05-05 16:14:56');
INSERT INTO public.oms VALUES (23, '12º Grupo﻿ de Artilharia Antiaérea de Selva', '12º GAAAe Sl', '2020-03-27 22:57:15', '2020-05-05 16:16:03');
INSERT INTO public.oms VALUES (22, '4ª Companhia de Inteligência', '4ª Cia Intlg', '2020-03-27 22:55:56', '2020-05-05 16:16:28');
INSERT INTO public.oms VALUES (8, '3ª Compania de Forças Especiais', '3ª Cia FE', '2020-03-27 22:45:04', '2020-05-05 16:16:46');
INSERT INTO public.oms VALUES (9, '4° Centro de Geoinformação', '4° CGEO', '2020-03-27 22:46:16', '2020-05-05 16:18:03');
INSERT INTO public.oms VALUES (18, '12ª Inspetoria de Contabilidade e Finanças do Exército', '12ª ICFEx', '2020-03-27 22:51:34', '2020-05-05 16:18:30');
INSERT INTO public.oms VALUES (67, 'Comissão de Seleção Permanente das Forças Armadas - Manaus', 'CSPFA 01 (MANAUS-AM)', '2020-05-05 16:20:43', '2020-05-05 16:21:14');
INSERT INTO public.oms VALUES (68, 'Comissões de Seleção das Forças Armadas - Porto Velho-RO', 'CSFA 02 (PORTO VELHO-RO)', '2020-05-05 16:23:24', '2020-05-05 16:23:24');
INSERT INTO public.oms VALUES (70, 'Comissões de Seleção  - Guajará-Mirin-RO', 'CS 04 (GUAJARÁ-MIRIM-RO)', '2020-05-05 16:26:22', '2020-05-05 16:26:22');
INSERT INTO public.oms VALUES (71, 'Comissões de Seleção das Forças Armadas - Rio Branco-AC', 'CSFA 06 (RIO BRANCO-AC)', '2020-05-05 16:27:24', '2020-05-05 16:27:24');
INSERT INTO public.oms VALUES (69, 'Comissões de Seleção das Forças Armadas - Boa Vista-RR', 'CSFA 03 (BOA VISTA-RR)', '2020-05-05 16:24:20', '2020-05-05 16:28:25');
INSERT INTO public.oms VALUES (72, 'Comissões de Seleção - Humaitá-AM', 'CS 07 (HUMAITÁ-AM)', '2020-05-05 16:29:06', '2020-05-05 16:29:06');
INSERT INTO public.oms VALUES (73, 'Comissões de Seleção - São Gabriel da Cachoeira-AM', 'CS 08 (SÃO GABRIEL DA CACHOEIRA-AM)', '2020-05-05 16:34:52', '2020-05-05 16:34:52');
INSERT INTO public.oms VALUES (74, 'Comissões de Seleção - Tabatinga-AM', 'CS 09 (TABATINGA-AM)', '2020-05-05 16:35:42', '2020-05-05 16:35:42');
INSERT INTO public.oms VALUES (75, 'Comissões de Seleção -  Tefé-AM', 'CS 10 (TEFÉ-AM)', '2020-05-05 16:36:16', '2020-05-05 16:36:16');
INSERT INTO public.oms VALUES (76, 'Comissões de Seleção - Colorado do Oeste-RO', 'CS 11 (COLORADO DO OESTE-RO)', '2020-05-05 16:36:59', '2020-05-05 16:36:59');
INSERT INTO public.oms VALUES (3, 'Comando Militar da Amazônia', 'Cmdo CMA', '2020-03-27 00:40:30', '2020-05-05 17:19:10');
INSERT INTO public.oms VALUES (92, 'Comando da 12ª Região Militar', 'CMDO 12ªRM', '2020-05-04 13:56:18', '2020-05-04 13:56:18');
INSERT INTO public.oms VALUES (77, 'Comissões de Seleção - Manicoré-AM', 'CS 12 (MANICORÉ-AM)', '2020-05-05 16:37:52', '2020-05-05 16:37:52');
INSERT INTO public.oms VALUES (78, 'Comissões de Seleção - Carauari-AM', 'CS 13 (CARAUARI-AM)', '2020-05-05 16:38:39', '2020-05-05 16:38:39');
INSERT INTO public.oms VALUES (79, 'Comissões de Seleção - Eirunepé-AM', 'CS 14 (EIRUNEPÉ-AM)-FAB', '2020-05-05 16:39:16', '2020-05-05 17:03:15');
INSERT INTO public.oms VALUES (80, 'Comissões de Seleção - Cruzeiro do Sul-AC', 'CS 05 (CRUZEIRO DO SUL-AC)', '2020-05-05 17:05:16', '2020-05-05 17:05:16');
INSERT INTO public.oms VALUES (81, 'Comissões de Seleção - Vilhena-RO', 'CS 14 (VILHENA-RO)', '2020-05-05 17:06:20', '2020-05-05 17:06:20');
INSERT INTO public.oms VALUES (82, 'Comissões de Seleção - Barcelos-AM', 'CS 17 (BARCELOS-AM)', '2020-05-05 17:07:41', '2020-05-05 17:07:41');
INSERT INTO public.oms VALUES (83, 'Comissões de Seleção - Parintins-AM', 'CS 18 (PARINTINS-AM)-MARINHA', '2020-05-05 17:08:38', '2020-05-05 17:08:38');
INSERT INTO public.oms VALUES (84, 'Posto de Recrutamento e Mobilização - Manaus-AM', 'PRM 12/001 - MANAUS - AM', '2020-05-05 17:10:33', '2020-05-05 17:10:55');
INSERT INTO public.oms VALUES (85, 'Posto de Recrutamento e Mobilização - Boa Vista-RR', 'PRM 12/002 - BOA VISTA-RR', '2020-05-05 17:11:40', '2020-05-05 17:11:40');
INSERT INTO public.oms VALUES (86, 'Posto de Recrutamento e Mobilização - Porto Velho-RO', 'PRM 12/003 - PORTO VELHO-RO', '2020-05-05 17:12:31', '2020-05-05 17:12:31');
INSERT INTO public.oms VALUES (87, 'Posto de Recrutamento e Mobilização - Rio Branco-AC', 'PRM 12/004 - RIO BRANCO-AC', '2020-05-05 17:13:13', '2020-05-05 17:13:13');
INSERT INTO public.oms VALUES (88, 'Posto de Recrutamento e Mobilização  - Tefé-AM', 'PRM 12/005 - TEFÉ-AM', '2020-05-05 17:13:54', '2020-05-05 17:13:54');
INSERT INTO public.oms VALUES (89, 'Posto de Recrutamento e Mobilização - Cruzeiro do Sul-AC', 'PRM 12/006 - CRUZEIRO DO SUL-AC', '2020-05-05 17:14:53', '2020-05-05 17:14:53');
INSERT INTO public.oms VALUES (90, 'Posto de Recrutamento e Mobilização - Tabatinga-AM', 'PRM 12/007 - TABATINGA-AM', '2020-05-05 17:15:46', '2020-05-05 17:15:46');
INSERT INTO public.oms VALUES (91, 'Posto de Recrutamento e Mobilização - São Gabriel da Cachoeira-AM', 'PRM 12/008 - SÃO GABRIEL DA CACHOEIRA-AM', '2020-05-05 17:16:42', '2020-05-05 17:16:42');
INSERT INTO public.oms VALUES (1, 'ADMINISTRADOR 12ª RM', 'ADMINISTRADOR 12ª RM', NULL, NULL);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: perguntas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: respostas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users VALUES (163, 'ciacmdo16bdainfsl', 'ciacmdo16bdainfsl@12rm.eb.mil.br', 'usuario', 44, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:27:34', 'pendente');
INSERT INTO public.users VALUES (162, 'ciacmdo12rm', 'ciacmdo12rm@12rm.eb.mil.br', 'usuario', 4, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:27:42', 'pendente');
INSERT INTO public.users VALUES (161, 'cfsol8bis', 'cfsol8bis@12rm.eb.mil.br', 'usuario', 50, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:28:16', 'pendente');
INSERT INTO public.users VALUES (159, 'cfro6bis', 'cfro6bis@12rm.eb.mil.br', 'usuario', 59, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:28:43', 'pendente');
INSERT INTO public.users VALUES (158, 'cfrn5bis', 'cfrn5bis@12rm.eb.mil.br', 'usuario', 57, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:28:56', 'pendente');
INSERT INTO public.users VALUES (157, 'cfac4bis', 'cfac4bis@12rm.eb.mil.br', 'usuario', 42, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:29:14', 'pendente');
INSERT INTO public.users VALUES (156, 'cecma', 'cecma@12rm.eb.mil.br', 'usuario', 17, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:29:21', 'pendente');
INSERT INTO public.users VALUES (150, '61bis', '61bis@12rm.eb.mil.br', 'usuario', 49, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:29:57', 'pendente');
INSERT INTO public.users VALUES (148, '54bis', '54bis@12rm.eb.mil.br', 'usuario', 61, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:30:02', 'pendente');
INSERT INTO public.users VALUES (141, '34pelpe', '34pelpe@12rm.eb.mil.br', 'usuario', 47, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:30:08', 'pendente');
INSERT INTO public.users VALUES (140, '32pelpe', '32pelpe@12rm.eb.mil.br', 'usuario', 29, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:30:12', 'pendente');
INSERT INTO public.users VALUES (137, '22pelpe', '22pelpe@12rm.eb.mil.br', 'usuario', 55, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:30:18', 'pendente');
INSERT INTO public.users VALUES (136, '21ciaecnstr', '21ciaecnstr@12rm.eb.mil.br', 'usuario', 52, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:30:23', 'pendente');
INSERT INTO public.users VALUES (131, '17pelpe', '17pelpe@12rm.eb.mil.br', 'usuario', 37, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:30:40', 'pendente');
INSERT INTO public.users VALUES (130, '17pelcom', '17pelcom@12rm.eb.mil.br', 'usuario', 38, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:30:48', 'pendente');
INSERT INTO public.users VALUES (129, '17ciainfsl', '17ciainfsl@12rm.eb.mil.br', 'usuario', 41, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:02', 'pendente');
INSERT INTO public.users VALUES (128, '17bis', '17bis@12rm.eb.mil.br', 'usuario', 45, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:08', 'pendente');
INSERT INTO public.users VALUES (127, '17balog', '17balog@12rm.eb.mil.br', 'usuario', 36, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:18', 'pendente');
INSERT INTO public.users VALUES (126, '16pelcomsl', '16pelcomsl@12rm.eb.mil.br', 'usuario', 48, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:25', 'pendente');
INSERT INTO public.users VALUES (125, '16balog', '16balog@12rm.eb.mil.br', 'usuario', 46, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:33', 'pendente');
INSERT INTO public.users VALUES (124, '12icfex', '12icfex@12rm.eb.mil.br', 'usuario', 18, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:43', 'pendente');
INSERT INTO public.users VALUES (123, '12gaaaesl', '12gaaaesl@12rm.eb.mil.br', 'usuario', 23, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:51', 'pendente');
INSERT INTO public.users VALUES (122, '12esqdcmec', '12esqdcmec@12rm.eb.mil.br', 'usuario', 28, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:31:57', 'pendente');
INSERT INTO public.users VALUES (121, '12bsup', '12bsup@12rm.eb.mil.br', 'usuario', 21, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:02', 'pendente');
INSERT INTO public.users VALUES (120, '10gacsl', '10gacsl@12rm.eb.mil.br', 'usuario', 32, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:15', 'pendente');
INSERT INTO public.users VALUES (155, '8bec', '8bec@12rm.eb.mil.br', 'usuario', 66, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:22', 'pendente');
INSERT INTO public.users VALUES (154, '7bpe', '7bpe@12rm.eb.mil.br', 'usuario', 25, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:27', 'pendente');
INSERT INTO public.users VALUES (153, '7bis', '7bis@12rm.eb.mil.br', 'usuario', 6, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:34', 'pendente');
INSERT INTO public.users VALUES (151, '6bec', '6bec@12rm.eb.mil.br', 'usuario', 33, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:47', 'pendente');
INSERT INTO public.users VALUES (149, '5bec', '5bec@12rm.eb.mil.br', 'usuario', 39, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:53', 'pendente');
INSERT INTO public.users VALUES (146, '4ciaintlg', '4ciaintlg@12rm.eb.mil.br', 'usuario', 22, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:33:09', 'pendente');
INSERT INTO public.users VALUES (145, '4cgeo', '4cgeo@12rm.eb.mil.br', 'usuario', 9, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:33:16', 'pendente');
INSERT INTO public.users VALUES (144, '4bavex', '4bavex@12rm.eb.mil.br', 'usuario', 20, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:33:28', 'pendente');
INSERT INTO public.users VALUES (143, '3ciafe', '3ciafe@12rm.eb.mil.br', 'usuario', 8, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:33:34', 'pendente');
INSERT INTO public.users VALUES (142, '3bis', '3bis@12rm.eb.mil.br', 'usuario', 60, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:33:42', 'pendente');
INSERT INTO public.users VALUES (139, '2pelcomsl', '2pelcomsl@12rm.eb.mil.br', 'usuario', 56, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:33:51', 'pendente');
INSERT INTO public.users VALUES (138, '2blogsl', '2blogsl@12rm.eb.mil.br', 'usuario', 58, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:33:59', 'pendente');
INSERT INTO public.users VALUES (135, '1pelcomsl', '1pelcomsl@12rm.eb.mil.br', 'usuario', 30, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:34:07', 'pendente');
INSERT INTO public.users VALUES (134, '1blogsl', '1blogsl@12rm.eb.mil.br', 'usuario', 34, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:34:29', 'pendente');
INSERT INTO public.users VALUES (133, '1bis', '1bis@12rm.eb.mil.br', 'usuario', 5, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:34:37', 'pendente');
INSERT INTO public.users VALUES (132, '1bcomsl', '1bcomsl@12rm.eb.mil.br', 'usuario', 24, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:34:50', 'pendente');
INSERT INTO public.users VALUES (147, '4cta', '4cta@12rm.eb.mil.br', 'usuario', 10, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', 'MySWwwcfsI0ykxKbnxAD8HTAnFNAEJGj6MXpqaDrTpbVGBBlX7AWCxDbuS0H', '2020-05-05 13:07:36', '2020-05-05 18:32:59', 'pendente');
INSERT INTO public.users VALUES (206, 'prm12007', 'prm12007@12rm.eb.mil.br', 'usuario', 90, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:14:13', 'pendente');
INSERT INTO public.users VALUES (203, 'prm12004', 'prm12004@12rm.eb.mil.br', 'usuario', 87, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:14:43', 'pendente');
INSERT INTO public.users VALUES (202, 'prm12003', 'prm12003@12rm.eb.mil.br', 'usuario', 86, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:14:50', 'pendente');
INSERT INTO public.users VALUES (201, 'prm12002', 'prm12002@12rm.eb.mil.br', 'usuario', 85, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:15:00', 'pendente');
INSERT INTO public.users VALUES (200, 'prm12001', 'prm12001@12rm.eb.mil.br', 'usuario', 84, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:15:08', 'pendente');
INSERT INTO public.users VALUES (199, 'pqrmnt12', 'pqrmnt12@12rm.eb.mil.br', 'usuario', 19, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:15:21', 'pendente');
INSERT INTO public.users VALUES (197, 'hgut', 'hgut@12rm.eb.mil.br', 'usuario', 51, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:22:13', 'pendente');
INSERT INTO public.users VALUES (198, 'hmam', 'hmam@12rm.eb.mil.br', 'usuario', 15, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:16:00', 'pendente');
INSERT INTO public.users VALUES (196, 'hgusgc', 'hgusgc@12rm.eb.mil.br', 'usuario', 53, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:22:22', 'pendente');
INSERT INTO public.users VALUES (195, 'hgupv', 'hgupv@12rm.eb.mil.br', 'usuario', 40, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:22:30', 'pendente');
INSERT INTO public.users VALUES (194, 'cspfa01', 'cspfa01@12rm.eb.mil.br', 'usuario', 67, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:22:44', 'pendente');
INSERT INTO public.users VALUES (193, 'csfa06', 'csfa06@12rm.eb.mil.br', 'usuario', 71, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:23:05', 'pendente');
INSERT INTO public.users VALUES (192, 'csfa03', 'csfa03@12rm.eb.mil.br', 'usuario', 69, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:23:32', 'pendente');
INSERT INTO public.users VALUES (191, 'csfa02', 'csfa02@12rm.eb.mil.br', 'usuario', 68, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:23:43', 'pendente');
INSERT INTO public.users VALUES (190, 'cs18marinha', 'cs18marinha@12rm.eb.mil.br', 'usuario', 83, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:23:55', 'pendente');
INSERT INTO public.users VALUES (189, 'cs17', 'cs17@12rm.eb.mil.br', 'usuario', 82, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:24:11', 'pendente');
INSERT INTO public.users VALUES (188, 'cs14fab', 'cs14fab@12rm.eb.mil.br', 'usuario', 79, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:24:20', 'pendente');
INSERT INTO public.users VALUES (187, 'cs14', 'cs14@12rm.eb.mil.br', 'usuario', 81, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:24:30', 'pendente');
INSERT INTO public.users VALUES (186, 'cs13', 'cs13@12rm.eb.mil.br', 'usuario', 78, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:24:36', 'pendente');
INSERT INTO public.users VALUES (185, 'cs12', 'cs12@12rm.eb.mil.br', 'usuario', 77, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:24:45', 'pendente');
INSERT INTO public.users VALUES (184, 'cs11', 'cs11@12rm.eb.mil.br', 'usuario', 76, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:24:54', 'pendente');
INSERT INTO public.users VALUES (183, 'cs10', 'cs10@12rm.eb.mil.br', 'usuario', 75, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:00', 'pendente');
INSERT INTO public.users VALUES (182, 'cs09', 'cs09@12rm.eb.mil.br', 'usuario', 74, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:09', 'pendente');
INSERT INTO public.users VALUES (181, 'cs08', 'cs08@12rm.eb.mil.br', 'usuario', 73, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:16', 'pendente');
INSERT INTO public.users VALUES (180, 'cs07', 'cs07@12rm.eb.mil.br', 'usuario', 72, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:23', 'pendente');
INSERT INTO public.users VALUES (179, 'cs05', 'cs05@12rm.eb.mil.br', 'usuario', 80, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:34', 'pendente');
INSERT INTO public.users VALUES (178, 'cs04', 'cs04@12rm.eb.mil.br', 'usuario', 70, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:41', 'pendente');
INSERT INTO public.users VALUES (177, 'cro12', 'cro12@12rm.eb.mil.br', 'usuario', 14, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:47', 'pendente');
INSERT INTO public.users VALUES (176, 'cmm', 'cmm@12rm.eb.mil.br', 'usuario', 13, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:25:53', 'pendente');
INSERT INTO public.users VALUES (175, 'cmdocma', 'cmdocma@12rm.eb.mil.br', 'usuario', 3, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:26:00', 'pendente');
INSERT INTO public.users VALUES (171, 'cmdo17bdainfsl', 'cmdo17bdainfsl@12rm.eb.mil.br', 'usuario', 62, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:26:16', 'pendente');
INSERT INTO public.users VALUES (170, 'cmdo16bdainfsl', 'cmdo16bdainfsl@12rm.eb.mil.br', 'usuario', 65, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:26:24', 'pendente');
INSERT INTO public.users VALUES (205, 'prm12006', 'prm12006@12rm.eb.mil.br', 'usuario', 89, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', 'Dd12ABJy7nLKrmbc5icgJZTgluXJ7wC9l1f38fqvYtwGIcpjH3fipKr8rwO9', '2020-05-05 13:07:36', '2020-05-05 18:14:29', 'pendente');
INSERT INTO public.users VALUES (173, 'cmdo2bdainfsl', 'cmdo2bdainfsl@12rm.eb.mil.br', 'usuario', 64, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:26:47', 'pendente');
INSERT INTO public.users VALUES (172, 'cmdo1bdainfsl', 'cmdo1bdainfsl@12rm.eb.mil.br', 'usuario', 26, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:26:55', 'pendente');
INSERT INTO public.users VALUES (169, 'cigs', 'cigs@12rm.eb.mil.br', 'usuario', 12, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:27:03', 'pendente');
INSERT INTO public.users VALUES (168, 'ciacmdocma', 'ciacmdocma@12rm.eb.mil.br', 'usuario', 11, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:27:13', 'pendente');
INSERT INTO public.users VALUES (164, 'ciacmdo17bdainfsl', 'ciacmdo17bdainfsl@12rm.eb.mil.br', 'usuario', 41, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:27:26', 'pendente');
INSERT INTO public.users VALUES (167, 'ciacmdo2gpte', 'ciacmdo2gpte@12rm.eb.mil.br', 'usuario', 16, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:27:51', 'pendente');
INSERT INTO public.users VALUES (166, 'ciacmdo2bdainfsl', 'ciacmdo2bdainfsl@12rm.eb.mil.br', 'usuario', 54, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:28:00', 'pendente');
INSERT INTO public.users VALUES (165, 'ciacmdo1bdainfsl', 'ciacmdo1bdainfsl@12rm.eb.mil.br', 'usuario', 27, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:28:08', 'pendente');
INSERT INTO public.users VALUES (207, 'prm12008', 'prm12008@12rm.eb.mil.br', 'usuario', 91, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:13:48', 'pendente');
INSERT INTO public.users VALUES (204, 'prm12005', 'prm12005@12rm.eb.mil.br', 'usuario', 88, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:14:36', 'pendente');
INSERT INTO public.users VALUES (160, 'cfrr7bis', 'cfrr7bis@12rm.eb.mil.br', 'usuario', 31, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', 'NKcvO5m8Z5wY2fion48oUrtPthsgtkM7vHLtmOqVtpxKymO77AQF2Lrkb3ye', '2020-05-05 13:07:36', '2020-05-05 18:28:27', 'pendente');
INSERT INTO public.users VALUES (152, '7bec', '7bec@12rm.eb.mil.br', 'usuario', 43, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', NULL, '2020-05-05 13:07:36', '2020-05-05 18:32:42', 'pendente');
INSERT INTO public.users VALUES (174, 'cmdo2gpte', 'cmdo2gpte@12rm.eb.mil.br', 'usuario', 63, '$2y$10$rgfGdx9Sn0a4H3YePKIM2uXz.9NcMdkBtfZyEBy6YjR.ZITWEEgJO', 'ZrAXBkctmLlSWkak7I8mZTt8NFdTjmrMw4fdny09AjG2NB63nH59jvzpYFtE', '2020-05-05 13:07:36', '2020-05-05 18:26:39', 'pendente');
INSERT INTO public.users VALUES (1, 'ADMINISTRADOR', 'admin@12rm.eb.mil.br', 'administrador', 1, '$2y$10$hYPHm1cHxbgsccQPtj5k1uaeZeKMufn5IlndfFKeAL7ZnmqWLHlry', 'FFjuNvHh7XrPMCSXlc8zbKqoHsg8WZElUBW18KTFiI3PYOHVDLCzy9MoMbFU', NULL, NULL, 'ativo');


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 15, true);


--
-- Name: om_pergunta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.om_pergunta_id_seq', 196, true);


--
-- Name: oms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.oms_id_seq', 92, true);


--
-- Name: perguntas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.perguntas_id_seq', 6, true);


--
-- Name: respostas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.respostas_id_seq', 2, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 207, true);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: om_pergunta om_pergunta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.om_pergunta
    ADD CONSTRAINT om_pergunta_pkey PRIMARY KEY (id);


--
-- Name: oms oms_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.oms
    ADD CONSTRAINT oms_pkey PRIMARY KEY (id);


--
-- Name: perguntas perguntas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perguntas
    ADD CONSTRAINT perguntas_pkey PRIMARY KEY (id);


--
-- Name: respostas respostas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respostas
    ADD CONSTRAINT respostas_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: om_pergunta om_pergunta_om_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.om_pergunta
    ADD CONSTRAINT om_pergunta_om_id_foreign FOREIGN KEY (om_id) REFERENCES public.oms(id) ON DELETE CASCADE;


--
-- Name: om_pergunta om_pergunta_pergunta_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.om_pergunta
    ADD CONSTRAINT om_pergunta_pergunta_id_foreign FOREIGN KEY (pergunta_id) REFERENCES public.perguntas(id) ON DELETE CASCADE;


--
-- Name: perguntas perguntas_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perguntas
    ADD CONSTRAINT perguntas_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: respostas respostas_pergunta_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respostas
    ADD CONSTRAINT respostas_pergunta_id_foreign FOREIGN KEY (pergunta_id) REFERENCES public.perguntas(id) ON DELETE CASCADE;


--
-- Name: respostas respostas_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respostas
    ADD CONSTRAINT respostas_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: users users_om_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_om_id_foreign FOREIGN KEY (om_id) REFERENCES public.oms(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

