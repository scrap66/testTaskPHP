--
-- PostgreSQL database dump
--

-- Dumped from database version 16.3
-- Dumped by pg_dump version 16.3

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

SET default_table_access_method = heap;

--
-- Name: user_accounts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_accounts (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.user_accounts OWNER TO postgres;

--
-- Name: user_accounts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_accounts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_accounts_id_seq OWNER TO postgres;

--
-- Name: user_accounts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_accounts_id_seq OWNED BY public.user_accounts.id;


--
-- Name: user_accounts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_accounts ALTER COLUMN id SET DEFAULT nextval('public.user_accounts_id_seq'::regclass);


--
-- Data for Name: user_accounts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_accounts (id, username, password) FROM stdin;
1	admin	$2y$13$d59UsvMdgh7.PJTOV0oPEub4Re8L35gHsPxZvnXkIZop7fZ2CVbpS
2	admin123	$2y$13$IxZox/ncSUb4.wISi5dlr.BsOxn.qomBkm1SBVuGb6JHHIGMVXWLa
3	qwerqq	$2y$13$u9k1CtVGVmLswro5ou.hMuBo7FRqMc9t.SK/4bX2RsZ/WESeDQ15S
4	qqqqqq	$2y$13$Q51uQZlhS/fJ9J7o07kytOeMGl7fhNkuwiApFWz6M4G0swzOpLK3G
5	qwerty123	$2y$13$BC7iCHkM4L143N2J7yDYvO5V7.ttu6aiBODVXv0AGUhUEXZkg/0lC
6	scorpyk	$2y$13$R3hyACWz5QjdJBT93w9aiuvS9mWu0iwxjLjW8HEQceLOsUgrg8Eo.
7	scorpyk8990	$2y$13$XKIm/P7ynbhmSUkAl4nTEOiZjINA2j/q.jcUhEQvvFAuoo2CqqYNC
\.


--
-- Name: user_accounts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_accounts_id_seq', 7, true);


--
-- Name: user_accounts user_accounts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_accounts
    ADD CONSTRAINT user_accounts_pkey PRIMARY KEY (id);


--
-- Name: user_accounts user_accounts_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_accounts
    ADD CONSTRAINT user_accounts_username_key UNIQUE (username);


--
-- PostgreSQL database dump complete
--

