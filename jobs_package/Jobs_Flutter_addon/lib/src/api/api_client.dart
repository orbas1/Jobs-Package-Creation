import 'dart:convert';

import 'package:http/http.dart' as http;
import 'package:meta/meta.dart';

/// Lightweight API client tailored for the Laravel jobs package endpoints.
class JobsApiClient {
  JobsApiClient({required this.baseUrl, http.Client? client})
      : _client = client ?? http.Client();

  final String baseUrl;
  final http.Client _client;

  Uri _uri(String path, [Map<String, String>? query]) {
    return Uri.parse(baseUrl).replace(path: path, queryParameters: query);
  }

  Future<Map<String, dynamic>> getJson(String path,
      {Map<String, String>? query}) async {
    final response = await _client.get(_uri(path, query));
    _throwIfInvalid(response);
    return _decode(response);
  }

  Future<Map<String, dynamic>> postJson(String path,
      {Map<String, String>? query, Map<String, dynamic>? body}) async {
    final response = await _client.post(
      _uri(path, query),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode(body ?? <String, dynamic>{}),
    );
    _throwIfInvalid(response);
    return _decode(response);
  }

  Future<Map<String, dynamic>> putJson(String path,
      {Map<String, dynamic>? body}) async {
    final response = await _client.put(
      _uri(path),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode(body ?? <String, dynamic>{}),
    );
    _throwIfInvalid(response);
    return _decode(response);
  }

  @visibleForTesting
  void dispose() => _client.close();

  void _throwIfInvalid(http.Response response) {
    if (response.statusCode >= 200 && response.statusCode < 300) {
      return;
    }
    throw JobsApiException(
      statusCode: response.statusCode,
      body: response.body,
    );
  }

  Map<String, dynamic> _decode(http.Response response) {
    final decoded = jsonDecode(response.body);
    if (decoded is Map<String, dynamic>) {
      return decoded;
    }
    throw const JobsApiException(statusCode: 500, body: 'Unexpected payload');
  }
}

class JobsApiException implements Exception {
  const JobsApiException({required this.statusCode, required this.body});

  final int statusCode;
  final String body;

  @override
  String toString() => 'JobsApiException(statusCode: $statusCode, body: $body)';
}
