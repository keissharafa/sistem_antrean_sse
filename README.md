# 🚦 Real-Time Queuing System with SSE

> A low-latency, real-time queue management system built to enhance operational efficiency and service monitoring.

## 🚀 Overview
Traditional queuing systems rely on heavy HTTP polling. This project optimizes server load and network traffic by implementing Server-Sent Events (SSE) for unidirectional, real-time updates. It is highly applicable for service centers, assembly line monitoring, or enterprise helpdesks.

## ✨ Key Features
* **Zero-Polling Real-Time Updates:** Utilizes Server-Sent Events (SSE) to push queue board updates instantly from the server to the client without overloading database queries.
* **Automated Voice Announcements:** Integrates browser-based Text-to-Speech (TTS) for automated queue calling.
* **Late Queue Handling:** Smart algorithmic workflows to manage missed or delayed queue numbers without disrupting the ongoing sequence.
* **Live Queue Monitoring:** Real-time dashboard for service operators to track load and efficiency.

## 🛠️ Tech Stack
* **Backend:** Laravel, PHP
* **Real-Time Protocol:** Server-Sent Events (SSE)
* **Frontend:** JavaScript

## 💡 Engineering Highlight
Transitioned from resource-heavy AJAX polling to SSE, significantly reducing database load and network latency while maintaining robust real-time state synchronization across multiple client instances.
