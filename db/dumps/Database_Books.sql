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
-- Name: books; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.books (
    id_book integer NOT NULL,
    name character varying(255) NOT NULL,
    article character varying(20),
    author character varying(50) NOT NULL,
    date_receipt date
);


ALTER TABLE public.books OWNER TO postgres;

--
-- Name: books_id_book_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.books_id_book_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.books_id_book_seq OWNER TO postgres;

--
-- Name: books_id_book_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.books_id_book_seq OWNED BY public.books.id_book;


--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client (
    id_client integer NOT NULL,
    full_name character varying(255) NOT NULL,
    passport character varying(25) NOT NULL
);


ALTER TABLE public.client OWNER TO postgres;

--
-- Name: client_id_client_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.client_id_client_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.client_id_client_seq OWNER TO postgres;

--
-- Name: client_id_client_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.client_id_client_seq OWNED BY public.client.id_client;


--
-- Name: distribution; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.distribution (
    id integer NOT NULL,
    id_client integer,
    date_issue date NOT NULL,
    id_book integer,
    id_employee integer,
    period interval NOT NULL
);


ALTER TABLE public.distribution OWNER TO postgres;

--
-- Name: distribution_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.distribution_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.distribution_id_seq OWNER TO postgres;

--
-- Name: distribution_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.distribution_id_seq OWNED BY public.distribution.id;


--
-- Name: employee; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employee (
    id_employee integer NOT NULL,
    full_name character varying(255) NOT NULL,
    post character varying(50)
);


ALTER TABLE public.employee OWNER TO postgres;

--
-- Name: employee_id_employee_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.employee_id_employee_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.employee_id_employee_seq OWNER TO postgres;

--
-- Name: employee_id_employee_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.employee_id_employee_seq OWNED BY public.employee.id_employee;


--
-- Name: returns; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.returns (
    id integer NOT NULL,
    id_distribution integer NOT NULL,
    id_book integer NOT NULL,
    id_employee integer NOT NULL,
    condition character varying(30),
    date_return date NOT NULL
);


ALTER TABLE public.returns OWNER TO postgres;

--
-- Name: return_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.return_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.return_id_seq OWNER TO postgres;

--
-- Name: return_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.return_id_seq OWNED BY public.returns.id;


--
-- Name: books id_book; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books ALTER COLUMN id_book SET DEFAULT nextval('public.books_id_book_seq'::regclass);


--
-- Name: client id_client; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN id_client SET DEFAULT nextval('public.client_id_client_seq'::regclass);


--
-- Name: distribution id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.distribution ALTER COLUMN id SET DEFAULT nextval('public.distribution_id_seq'::regclass);


--
-- Name: returns id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.returns ALTER COLUMN id SET DEFAULT nextval('public.return_id_seq'::regclass);


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.books (id_book, name, article, author, date_receipt) FROM stdin;
4	Martin Iden	0003482821	Jack London	2024-03-12
3	1984	000192929321	Orewell	2023-02-21
5	Moby-dyck	000282183	Herman Mellville	2022-06-12
6	The count of Monte Cristo	0002741721	Alexandres Dumas	2023-12-18
\.


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.client (id_client, full_name, passport) FROM stdin;
1	Иванов Иван Иванович	122043291921
3	Бобелев Алексей Дмитрьеич	12202918211
4	Марьянова Алина Вадимовна	22001821921
\.


--
-- Data for Name: distribution; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.distribution (id, id_client, date_issue, id_book, id_employee, period) FROM stdin;
8	1	2000-01-01	3	1	1 year
9	3	2024-05-12	5	1	25 days
10	4	2024-06-01	5	1	1 mon
11	4	2024-01-01	6	1	1 year
\.


--
-- Data for Name: employee; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.employee (id_employee, full_name, post) FROM stdin;
1	Васильев Алексей Денисович	Директор
2	йцу	1234512
3	Ермошин Ярослав 	Раб
\.


--
-- Data for Name: returns; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.returns (id, id_distribution, id_book, id_employee, condition, date_return) FROM stdin;
6	8	3	1	\N	2001-01-01
7	9	5	1	\N	2024-06-06
8	10	5	1	\N	2024-07-01
9	11	6	1	\N	2025-01-01
\.


--
-- Name: books_id_book_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.books_id_book_seq', 6, true);


--
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_id_client_seq', 4, true);


--
-- Name: distribution_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.distribution_id_seq', 11, true);


--
-- Name: employee_id_employee_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.employee_id_employee_seq', 3, true);


--
-- Name: return_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.return_id_seq', 9, true);


--
-- Name: books books_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_pkey PRIMARY KEY (id_book);


--
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- Name: distribution distribution_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.distribution
    ADD CONSTRAINT distribution_pkey PRIMARY KEY (id);


--
-- Name: employee employee_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_pkey PRIMARY KEY (id_employee);


--
-- Name: returns return_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.returns
    ADD CONSTRAINT return_pkey PRIMARY KEY (id);


--
-- Name: distribution distribution_id_book_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.distribution
    ADD CONSTRAINT distribution_id_book_fkey FOREIGN KEY (id_book) REFERENCES public.books(id_book);


--
-- Name: distribution distribution_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.distribution
    ADD CONSTRAINT distribution_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- Name: distribution distribution_id_employee_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.distribution
    ADD CONSTRAINT distribution_id_employee_fkey FOREIGN KEY (id_employee) REFERENCES public.employee(id_employee);


--
-- Name: returns return_id_book_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.returns
    ADD CONSTRAINT return_id_book_fkey FOREIGN KEY (id_book) REFERENCES public.books(id_book);


--
-- Name: returns return_id_employee_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.returns
    ADD CONSTRAINT return_id_employee_fkey FOREIGN KEY (id_employee) REFERENCES public.employee(id_employee);


--
-- PostgreSQL database dump complete
--

