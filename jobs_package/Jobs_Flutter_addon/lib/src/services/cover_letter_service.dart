import '../models/cover_letter.dart';
import 'api_client.dart';

class CoverLetterService {
  CoverLetterService(this.client);

  final JobsApiClient client;

  Future<List<CoverLetter>> fetchLetters() async {
    final payload = await client.getJson('/api/cover-letters');
    return (payload['data'] as List<dynamic>? ?? [])
        .map((e) => CoverLetter.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<void> saveLetter(CoverLetter letter) async {
    await client.postJson('/api/cover-letters/${letter.id ?? ''}', body: letter.toJson());
  }
}
